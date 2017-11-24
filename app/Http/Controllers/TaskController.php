<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

use Taskly\Transformers\TaskTransformer;

use Taskly\Task;
use Taskly\TaskList;

class TaskController extends Controller
{
    /**
     * |------------------------------------------------------------------------
     * |    Constructor
     * |------------------------------------------------------------------------
     */
    public function __construct(Task $task, TaskList $tasklist)
    {
        $this->task = $task;
        $this->tasklist = $tasklist;
        $this->authenticated = \Auth::user();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching all tasks from a tasklist
     * |------------------------------------------------------------------------
     */
    public function index($list_slug)
    {
        $tasklist = $this->tasklist->whereSlug($list_slug)->firstOrFail();
        return fractal(
            $this->task->whereTaskListId($tasklist->id)->get(),
            new TaskTransformer()
        )->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching a single tasks from a tasklist
     * |------------------------------------------------------------------------
     */
    public function task($list_slug, $slug)
    {
        $tasklist = $this->tasklist->whereSlug($list_slug)->firstOrFail();
        return fractal(
            $this->task->whereSlug($slug)->whereTaskListId($tasklist->id)->first(),
            new TaskTransformer()
        )->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Set custom priority to a task
     * |------------------------------------------------------------------------
     */
    public function setPriority(Request $request, $list_slug, $slug)
    {
        $request->validate([
            'priority' => ''
        ]);

        // dd($request->all());

        if (!$request->get('priority')) {
            return response()->json([
                'error' => 'No priority was set'
            ], 422);
        }

        $this->task->whereSlug($slug)->update([
            'priority' => $request->get('priority')
        ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    check/uncheck a task to be done or undone
     * |------------------------------------------------------------------------
     */
    public function toggleTaskCheck(Request $request, $list_slug, $id)
    {
        $request->validate([ 'check' => '' ]);

        if (!$request->get('check')) {
            return response()->json([
                'error' => 'Task could not be checked'
            ]);
        }

        $this->task->whereId($id)->update(['is_checked' => $request->get('check')]);
    }


    /**
     * |------------------------------------------------------------------------
     * |    Create new task resource
     * |------------------------------------------------------------------------
     */
    public function create(Request $request, $list_slug)
    {
        $request->validate([
            'name' => 'required',
            'priority' => '',
        ]);

        $tasklist = $this->tasklist->whereSlug($list_slug)->firstOrFail();

        try {
            $this->task->create([
                'name' => $request->get('name'),
                'slug' => str_replace('-', ' ', strtolower($request->get('name'))),
                'task_list_id' => $tasklist->id,
                'user_id' => $this->authenticated->id,
                'priority' => ($request->get('priority')) ? $request->get('priority') : 'No priority'
            ]);

            dd($this->task->latest());
        } catch (BadMethodCallException $e) {
            return $e;
        }
    }
}
