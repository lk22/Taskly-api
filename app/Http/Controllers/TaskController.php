<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;
// use Taskly\Http\Resources\TaskResource;
// use Taskly\Http\Resources\TaskCollection;
 
use Taskly\Transformers\TaskTransformer;

use Taskly\Task;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
    	$this->task = $task;
    }

    public function index()
    {
    	return fractal(
            $this->task->all(),
            new TaskTransformer()
        )->toArray();
    }

    public function task($task_slug)
    {
    	return fractal(
            $this->task->whereSlug($task_slug)->first(),
            new TaskTransformer()
        )->toArray();
    }
}
