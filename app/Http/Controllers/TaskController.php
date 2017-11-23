<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

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
            'priority' => ''
        ]);

        // dd($request->all());

        if(!$request->get('priority')) {
            return response()->json([
                'error' => 'No priority was set'
            ], 422);
        }

        $this->task->whereSlug($slug)->update([
            'priority' => $request->get('priority')
        ]);

    }

    public function toggleTaskCheck(Request $request, $id)
    {
        $request->validate([ 'check' => '' ]);

        if( !$request->get('check') ) {
            return response()->json([
                'error' => 'Task could not be checked'
            ]);
        }

        $this->task->whereId($id)->update(['is_checked' => $request->get('check')]);
    }
}

