<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myEventsManagement()
    {
        $user = Auth::user();
        if($user){
            $table = 'elements';
            $columns = DB::select("SHOW COLUMNS FROM ". $table." WHERE Field = 'type'");
            preg_match("/^enum\(\'(.*)\'\)$/", $columns[0]->Type, $matches);
            $enum = explode("','", $matches[1]); //in $enum are all input types for an element
    
             $myEvents = Event::where('user_id',$user->id)->get();  //only this user's events will show up
             return view('users.events',compact('myEvents','enum'));
        }else{
            return redirect('/');
        }
    }

    public function eventManagement($id)
    {
        $event = Event::find($id);
        $subscriptions = $event->users()->get();
        return view('users.eventManagement',compact('event','subscriptions'));
    }
}
