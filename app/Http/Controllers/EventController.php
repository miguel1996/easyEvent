<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Element;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ElementController;

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
            $table = 'elements';
            $columns = DB::select("SHOW COLUMNS FROM ". $table." WHERE Field = 'type'");
            preg_match("/^enum\(\'(.*)\'\)$/", $columns[0]->Type, $matches);
            $enum = explode("','", $matches[1]); //in $enum are all input types for an element
            $events = Event::all();
            return view('events.events', compact('events', 'enum'));
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
        //transaction: rollbacks if any exception occurs
        DB::transaction(function () use ($request) {  //"use" serves to pass the request variable from the parent scope to the DB::transaction scope
        $result_create_elements = app('App\Http\Controllers\ElementController')->create($request);
            if (!$result_create_elements[0]) {
                return dd("erro ao inserir elementos");
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
            if (!$event->save()) {
                return dd("erro ao criar o evento");
            }
            $event->elements()->attach($result_create_elements[1]);//attaches all element ids that are in the $result_create_elements[1] array to the event-elements intermediary table

            // return redirect('/events');
        });
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
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user) {
            $event = Event::find($id);
            return view('events.eventDetail', compact('event'));
        } else {
            return redirect('/');
        }
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
    public function update(Request $request, Event $event)
    {
        //
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
}
