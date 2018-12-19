<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;

class EventController extends Controller
{
    public $successStatus = 200;
    /**
         * all events api
         *
         * @return \Illuminate\Http\Response
         */
        public function allEvents()
        {
            $events = Event::all();
            return response()->json(['success' => $events], $this-> successStatus);
        }
}
