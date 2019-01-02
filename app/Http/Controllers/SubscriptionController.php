<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user){ 
             $subscriptions = $user->events()->where('event_date','>=', Carbon::now())->orderBy('event_date','asc')->get();
             
             //get weather if possible
             
             $client = new \GuzzleHttp\Client();
             $data = $client->request('GET', 'https://api.openweathermap.org/data/2.5/forecast?id=2593105&appid=c0d3d6d2e29c32877223d60ce0071fa6&units=metric');
            $body = $data->getBody();
            $data = json_decode($body);

            $iteration = 0;
            $weather_data = array();
            foreach($data->list as $val){
                $date = gmdate("d-m-Y",$val->dt);
                $dateCmp = gmdate("H",$val->dt);
                $weather = $val->weather;
            if (strcmp($dateCmp,"12") == 0){         
            array_push($weather_data, array("date" => $date, "temp" => $val->main->temp, "icon" => $weather[0]->icon, "icon_desc" => $weather[0]->description));
            }
            $iteration++;
            }
             return view('subscriptions.subscriptions',compact('subscriptions','user','weather_data'));
        }else{
            return redirect('/');
        }
    }

    public function registUser(Request $request,$id)
    {
        $user = Auth::user();
        if ($user) {
            $event = Event::find($id);
            $subscription_elements_data = array();
            foreach($event->elements as $element)
            {
                switch ($element->type) {
                    case 'file':
                    $file = $request->file('element'.$element->id);
                    $filename = time().'-'.$file->getClientOriginalName();
                    $file = $file->move('images/subscriptions/files', $filename);
                    $value = $filename;
                    break;

                    default:
                    $value = $request->input('element'.$element->id);
                        break;
                }
                $subscription_elements_data = array_add($subscription_elements_data,$element->id,$value);
            }

            $serialized_data = serialize($subscription_elements_data);
            //DB::transaction: rollbacks if any exception occurs
       $transaction_result = DB::transaction(function () use ($id,$user,$serialized_data,$request) {  //"use" serves to pass the request variable from the parent scope to the DB::transaction function scope
            if (!$user->events->contains($id)) {
                $user->events()->attach($id, ['data' => $serialized_data]);
                $request->session()->flash('status', 'Successfully subscribed to this event!');
            }
            else{
                $request->session()->flash('status', 'You are already subscribed to this event!');
            }
           return true;//redirect('events');
       });
        } else {
            return false;//redirect('/'); if it is not an autenticated user, we get redirected to the root endpoint
        }
        if (!$transaction_result) {
            $request->session()->flash('status', 'Error subscribing to the event!');
            return redirect('/');
        } else {        
            return redirect('/events/'.$id);
        }
    }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function cancel(Request $request)
    // {
    //     $user = Auth::user();
    //     if ($event = Event::find($request->event_id)) {
    //         if ($event->closing_subscription_date > Carbon::now()) {
    //             if ($user->events()->detach($request->event_id)) {
    //                 $request->session()->flash('status', 'subscrição do evento '.$request->event_id.' cancelada com sucesso');
    //             } else {
    //                 $request->session()->flash('status', 'Erro ao cancelar a subscrição');
    //             }
    //         }else{
    //             $request->session()->flash('status', 'data de fecho ja passou');
    //         }
    //     }else{
    //         $request->session()->flash('status', 'Evento nao existente');
    //     }
    //     return redirect('/subscriptions');
    // }

    /**
     * Remove the specified resource from storage through an ajax call.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelAJAX(Request $request)
    {
        $user = Auth::user();
        if ($event = Event::find($request->event_id)) {
            if ($event->closing_subscription_date > Carbon::now()) {
                if ($user->events()->detach($request->event_id)) {
                    return response("subscrição do evento '.$request->event_id.' cancelada com sucesso", 200)->header('Content-Type', 'text/plain');
                } else {
                    return response("Erro ao cancelar a subscrição", 409)->header('Content-Type', 'text/plain');
                }
            }else{
                return response("data de fecho ja passou", 403)->header('Content-Type', 'text/plain');
            }
        }else{
            return response("Evento nao existente", 404)->header('Content-Type', 'text/plain');
        }
    }
}
