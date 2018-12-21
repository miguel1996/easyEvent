<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //ADMIN USER CONTROLLER

    //shows all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.users',compact('users'));
    }
}
