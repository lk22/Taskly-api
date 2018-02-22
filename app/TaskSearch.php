<?php

namespace Taskly;

use Illuminate\Http\Request;

use Taskly\Task;

class TaskSearch 
{

	/**
     * |-------------------------------------------
     * |
     * | Applying task searching filters
     * |
     * |-------------------------------------------
     */
	public static function apply(Request $filters) {
		$task = (new Task)->newQuery();

		if($filters->has('interval')) {
			// code here
		}
	}

}