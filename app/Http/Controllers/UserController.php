<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Event;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myEvents()
    {
        $user = Auth::user();
        if($user){
             $myEvents = Event::where('user_id',$user->id)->get();
             return view('users.events',compact('myEvents'));
        }else{
            return redirect('/');
        }
    }
}
