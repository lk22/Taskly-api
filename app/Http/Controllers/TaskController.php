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

    public function task($slug)
    {
    	return fractal(
            $this->task->whereSlug($slug)->first(),
            new TaskTransformer()
        )->toArray();
    }

    public function setPriority(Request $request, $slug)
    {
        $request->validate([
            'priority' => 'required'
        ]);

        $task = $this->task->whereSlug($slug)->firstOrFail();

        if(!$request->get('priority')) {
            return response()->json([
                'error' => 'No priority was set'
            ], 422);
        }

        $task->priority = $request->get('priority');

        $task->save();

        return $task;
    }

    public function toggleTaskCheck(Request $request, $id)
    {
        $request->validate([ 'check' => 'boolean' ]);

        $task = $this->task->whereId($id)->firstOrfail();

        if( !$request->get('check') ) {
            return response()->json([
                'error' => 'Task could not be checked'
            ]);
        }

        $task->is_checked = $request->get('check');

        $task->save();
    }
}

