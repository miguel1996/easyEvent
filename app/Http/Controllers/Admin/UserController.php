<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UserController extends Controller
{
    //ADMIN USER CONTROLLER

    //shows all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.users',compact('users'));
    }

    //register user
    public function registUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'date_of_birth' => ['required','date','before:tomorrow'],
            'address' => ['required','string'],
            'phone_number' => ['required','integer'],
            'gender' => ['required','string'],
            'group_id' => ['required','integer'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //$input['group_id'] = 2;//by default its in the member group
        $user = User::create($input);
        //$success['token'] =  $user->createToken('MyApp')-> accessToken;
        //$success['name'] =  $user->name;
        return response()->json(['success'=>$user], 200);
    }
    
}
