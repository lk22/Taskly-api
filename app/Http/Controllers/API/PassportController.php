<?php

namespace Taskly\Http\Controllers\API;

use Illuminate\Http\Request;
use Taskly\Http\Controllers\Controller;

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
    			'success' => $success
    		], $this->statusCode);
    	}
    }

    public function register(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    		'c_password' => 'required|same:password'
    	]);

    	if($request->fails()) {
    		return response()->json([
    			'error' => $request->errors()
    		], 401);
    	}

    	$input = $request->all();

    	$input['password'] = bcrypt($input['password']);

    	$user = \User::create($input);
    	$success['token'] = $user->createToken('auth')->accessToken;
    	$success['name'] = $user->name;

    	return response()->json([
    		'success' => $success
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
