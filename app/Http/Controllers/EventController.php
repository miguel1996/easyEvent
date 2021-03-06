<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ElementController;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $events = Event::where('event_date','>=', Carbon::now())
            ->orderBy('event_date','asc')
            ->get();
            return view('events.events', compact('events'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            //DB::transaction: rollbacks if any exception occurs
        $transaction_result = DB::transaction(function () use ($request,$user) {  //"use" serves to pass the request variable from the parent scope to the DB::transaction function scope
        $result_create_elements = app('App\Http\Controllers\ElementController')->create($request);
            if (!$result_create_elements[0]) {
                return false;//dd("erro ao inserir elementos");
            }
            // event creation
            $file = $request->file('event_photo');
            $filename = time().'-'.$file->getClientOriginalName();
            $file = $file->move('images/event_photos', $filename);
            $event = new Event;
            $event->image_path = $filename;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->event_date = $request->event_date;
            $event->opening_subscription_date = $request->opening_subscription_date;
            $event->closing_subscription_date = $request->closing_subscription_date;
            $event->user_id = $user->id;
            if (!$event->save()) {
                return false;//dd("erro ao criar o evento");
            }
            $event->elements()->attach($result_create_elements[1]);//attaches all element ids that are in the $result_create_elements[1] array to the event-elements intermediary table

            return true;//redirect('/events');
        });
        if(!$transaction_result)
        {
            $request->session()->flash('status', 'Error creating the event!');
        }
        else{
            $request->session()->flash('status', 'Event created successfully!');
            return redirect('/user/events');
        }
        //fim de if($user)
        } else {
            return redirect('/');//if it is not an autenticated user, we get redirected to the root endpoint
        }
    }

    // public function registUser(Request $request,$id)
    // {
    //     $user = Auth::user();
    //     if ($user) {
    //         $event = Event::find($id);
    //         $subscription_elements_data = array();
    //         foreach($event->elements as $element)
    //         {
    //             switch ($element->type) {
    //                 case 'file':
    //                 $file = $request->file('element'.$element->id);
    //                 $filename = time().'-'.$file->getClientOriginalName();
    //                 $file = $file->move('images/subscriptions/files', $filename);
    //                 $value = $filename;
    //                 break;

    //                 default:
    //                 $value = $request->input('element'.$element->id);
    //                     break;
    //             }
    //             $subscription_elements_data = array_add($subscription_elements_data,$element->id,$value);
    //         }

    //         $serialized_data = serialize($subscription_elements_data);
    //         //DB::transaction: rollbacks if any exception occurs
    //    $transaction_result = DB::transaction(function () use ($id,$user,$serialized_data,$request) {  //"use" serves to pass the request variable from the parent scope to the DB::transaction function scope
    //         if (!$user->events->contains($id)) {
    //             $user->events()->attach($id, ['data' => $serialized_data]);
    //             $request->session()->flash('status', 'Successfully subscribed to this event!');
    //         }
    //         else{
    //             $request->session()->flash('status', 'You are already subscribed to this event!');
    //         }
    //        return true;//redirect('events');
    //    });
    //     } else {
    //         return false;//redirect('/'); if it is not an autenticated user, we get redirected to the root endpoint
    //     }
    //     if (!$transaction_result) {
    //         $request->session()->flash('status', 'Error subscribing to the event!');
    //         return redirect('/');
    //     } else {        
    //         return redirect('/events/'.$id);
    //     }
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user) {
            $event = Event::find($id);
            $isSubscribed = $user->events->contains($id);
            return view('events.eventDetail', compact('event','isSubscribed'));
        } else {
            return redirect('/');
        }
    }

    public function showEventManagement($id)
    {
        $event = Event::find($id);
       
        $table = 'elements';
            $columns = DB::select("SHOW COLUMNS FROM ". $table." WHERE Field = 'type'");
            preg_match("/^enum\(\'(.*)\'\)$/", $columns[0]->Type, $matches);
            $enum = explode("','", $matches[1]); //in $enum are all input types for an element
        $subscriptions = $event->users()->get();
        if($event->opening_subscription_date < Carbon::now())
        {
            $canEditEvent = false;
        }else{
            $canEditEvent = true;
        }
        $elements = Element::distinct()->get(['label']);
        return view('users.eventManagement',compact('event','subscriptions', 'enum','canEditEvent','elements'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($event = Event::find($id)) {
            if ($event->opening_subscription_date > Carbon::now()) {
                $transaction_result = DB::transaction(function () use ($request,$id,$event) {  //"use" serves to pass the request variable from the parent scope to the DB::transaction function scope
                //first delete all elements
                if(!app('App\Http\Controllers\ElementController')->destroyAll($id))
                    return $request->session()->flash('status', 'Erro ao editar os elementos antigos');//sai da funcao da transação
                //then insert the new ones in the request
                $result_create_elements = app('App\Http\Controllers\ElementController')->create($request);
                if (!$result_create_elements[0]) {
                    $request->session()->flash('status', 'Erro ao editar elementos');
                }
                $event->elements()->attach($result_create_elements[1]);//attaches all element ids that are in the $result_create_elements[1] array to the event-elements intermediary table
                //event update
                //delete the current image if a new one comes in the request
                if ($request->file('event_photo')) {
                    File::delete(public_path().'/images/event_photos/'.$event->image_path);

                    $file = $request->file('event_photo');
                    $filename = time().'-'.$file->getClientOriginalName();
                    $file = $file->move('images/event_photos', $filename);
                    $event->image_path = $filename;
                }
                $event->title = $request->title;
                $event->description = $request->description;
                $event->event_date = $request->event_date;
                $event->opening_subscription_date = $request->opening_subscription_date;
                $event->closing_subscription_date = $request->closing_subscription_date;
                if (!$event->save()) {
                    $request->session()->flash('status', 'Update Error!');
                }
                // $event->elements()->attach($result_create_elements[1]);//attaches all element ids that are in the $result_create_elements[1] array to the event-elements intermediary table
    
                $request->session()->flash('status', 'Event updated successfully!');
            });



                // if ($user->events()->detach($request->event_id)) {
                //     $request->session()->flash('status', 'subscrição do evento '.$request->event_id.' cancelada com sucesso');
                // } else {
                //     $request->session()->flash('status', 'Erro ao cancelar a subscrição');
                // }
            } else {
                $request->session()->flash('status', 'Não pode editar um evento que já esteja aberto a subscrições');
            }
        } else {
            $request->session()->flash('status', 'Evento nao existente');
        }
        return redirect('/user/events');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function attachElement(){
        return dd("OLA");
    }
}
