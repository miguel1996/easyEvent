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
            return redirect()->back()->withErrors($validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['state'] = '1';
        $user = User::create($input);
        $request->session()->flash('status', 'registered new user!');
        // return redirect()->back();
        return view('admin.index');
    }
 
    public function showUser($id){
        $user = User::find($id);
        return view('admin.users.editUser',compact('user'));
    }

    public function editUser(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'c_password' => 'same:password',
            'date_of_birth' => ['required','date','before:tomorrow'],
            'address' => ['required','string'],
            'phone_number' => ['required','integer'],
            'gender' => ['required','string'],
            'group_id' => ['required','integer'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $user = User::find($id);
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->group_id = $request->group_id;
        if($request->password != "")
        {
           $user->password = bcrypt($request->password);
        }
        $user->save();
        $request->session()->flash('status', 'user updated successfully');
        return view('admin.index');
    }
}
