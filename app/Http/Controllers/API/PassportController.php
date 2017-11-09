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
}
