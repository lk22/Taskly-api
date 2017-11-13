<?php

namespace Taskly\Http\Controllers\API;

use Illuminate\Http\Request;
use Taskly\Http\Controllers\Controller;

use Taskly\User;

class PassportController extends Controller
{
    public $statusCode = 200;

    public function login()
    {
    	if(
    		\Auth::attempt([
    			'email' => request('email'),
    			'password' => request('password')]
    		)
    	) {
    		$user = \Auth::user();
    		$success['token'] = $user->createToken('auth')->accessToken;

    		return response()->json([
    			'success' => $success,
    			'authUser' => $user
    		], $this->statusCode);
    	}
    }

    public function register(Request $request)
    {
    	$request->validate([
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    		'c_password' => 'required|same:password'
    	]);

    	$input = $request->all();

    	$user = User::create([
    		'firstname' => $input['firstname'],
    		'lastname' => $input['lastname'],
    		'name' => $input['firstname'] . ' ' . $input['lastname'],
    		'slug' => strtolower($input['firstname']) . '-' . strtolower($input['lastname']),
    		'email' => $input['email'],
    		'password' => bcrypt($input['password']),
    		'remember_token' => str_random(10)
    	]);

    	$success['token'] = $user->createToken('auth')->accessToken;
    	$success['name'] = $user->name;

    	return response()->json([
    		'token' => $success
    	], $this->statusCode);
    }

    public function getDetails()
    {
    	$user = \Auth::user();
    	return response()->json([
    		'success' => $user
    	], $this->statusCode);
    }
}
