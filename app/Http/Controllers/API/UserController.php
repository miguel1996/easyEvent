<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public $notAuthorizedStatus = 401;
    /**
         * login api
         *
         * @return \Illuminate\Http\Response
         */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['sucesso' => $success], $this-> successStatus);
        } else {
            return response()->json(['erro'=>'Nao autorizado'], $this-> notAuthorizedStatus);
        }
    }
    /**
         * Register api
         *
         * @return \Illuminate\Http\Response
         */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'date_of_birth' => ['required','date','before:tomorrow'],
            'address' => ['required','string'],
            'phone_number' => ['required','integer'],
            'gender' => ['required','string'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], $this-> notAuthorizedStatus);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['group_id'] = 2;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
         * details api
         *
         * @return \Illuminate\Http\Response
         */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
}
