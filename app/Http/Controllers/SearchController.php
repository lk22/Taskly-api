<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;
use Taskly\Task;
use Taskly\Search\TaskSearch;

class SearchController extends Controller
{
    public function filter(Request $request) {
    	return TaskSearch::apply($request);
    }
}
