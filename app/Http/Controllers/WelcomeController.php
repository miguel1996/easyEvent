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
        $events = Event::whereDate('opening_subscription_date','<', Carbon::now()->toDateTimeString())->get();
        return view('welcome',compact('events'));
    }
}
