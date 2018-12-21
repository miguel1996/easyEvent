<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;

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
             $subscriptions = $user->events()->get();
             return view('subscriptions.subscriptions',compact('subscriptions','user'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $user = Auth::user();
        if ($event = Event::find($request->event_id)) {
            if ($event->closing_subscription_date > Carbon::now()) {
                if ($user->events()->detach($request->event_id)) {
                    $request->session()->flash('status', 'subscrição do evento '.$request->event_id.' cancelada com sucesso');
                } else {
                    $request->session()->flash('status', 'Erro ao cancelar a subscrição');
                }
            }else{
                $request->session()->flash('status', 'data de fecho ja passou');
            }
        }else{
            $request->session()->flash('status', 'Evento nao existente');
        }
        return redirect('/subscriptions');
    }
}
