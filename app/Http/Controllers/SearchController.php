<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;
use Taskly\Task;

class SearchController extends Controller
{
    public function filter(Request $request, $query) {
    	$data = $request->all();

    	dd($data);
    }
}
