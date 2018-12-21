<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        // $event = Event::find($id);
        $events = Event::where('opening_subscription_date','<', Carbon::now())
        ->where('closing_subscription_date','>',Carbon::now())
        ->orderBy('closing_subscription_date','asc')
        ->get();
        return view('welcome',compact('events'));
    }
}
