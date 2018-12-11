<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class WelcomeController extends Controller
{
    public function index()
    {
        // $event = Event::find($id);
        $events = Event::all();
        return view('welcome',compact('events'));
    }
}
