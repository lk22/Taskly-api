<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{

	public function index()
	{
		return view('welcome');
	}

    public function app()
    {
    	return view('spa');
    }
}
