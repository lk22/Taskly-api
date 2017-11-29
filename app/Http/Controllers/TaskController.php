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
    public function index()
    {
        return fractal(
            $this->task->all(),
            new TaskTransformer()
        )->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching a single tasks from a tasklist
     * |------------------------------------------------------------------------
     */
    public function task($slug)
    {
        return fractal(
            $this->task->whereSlug($slug)->firstOrFail(),
            new TaskTransformer()
        )->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Set custom priority to a task
     * |------------------------------------------------------------------------
     */
    public function setPriority(Request $request, $slug)
    {
        $request->validate([
            'priority' => ''
        ]);

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
    public function toggleTaskCheck(Request $request, $id)
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
     * |    check all tasks
     * |------------------------------------------------------------------------
     */
    public function checkAllTasks(Request $request)
    {
        $request->validate([
            'check' => ''
        ]);

        $this->task->whereIsChecked(false)->update([
            'is_checked' => $request->get('check')
        ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Uncheck all tasks on the tasklist
     * |------------------------------------------------------------------------
     */
    public function uncheckAllTasks(Request $request)
    {
        $request->validate([
            'check' => ''
        ]);

        $this->task->whereIsChecked(true)->update([
            'is_checked' => $request->get('check')
        ]);
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
            'work_hours' => 'required'
        ]);

        $tasklist = $this->tasklist->whereSlug($list_slug)->firstOrFail();

        $this->task->create([
            //'name' => preg_match("/^[a-zA-Z0-9ÆØÅæøå]+$/i^", $request->get('name')),
            'name' => $request->get('name'),
            'slug' => str_replace('-', ' ', strtolower($request->get('name'))),
            'task_list_id' => $tasklist->id,
            'user_id' => $this->authenticated->id,
            'priority' => $request->get('priority'),
            'work_hours' => $request->get('work_hours')
        ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Update existing task resource
     * |------------------------------------------------------------------------
     */
    public function update(Request $request, $slug)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'priority' => 'required',
            'work_hours' => 'required',
        ]);

        $task = $this->task->whereSlug($slug)->firstOrFail();

        $task->update([
            //'name' => preg_match("/^[a-zA-Z0-9ÆØÅæøå]+$/i^", $request->get('name')),
            'name' => $request->get('name'),
            'slug' => str_replace('-', ' ', strtolower($request->get('name')))
        ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Update existing task resource
     * |------------------------------------------------------------------------
     */
    public function delete(Request $request, $slug)
    {
        $task = $this->task->whereSlug($slug)->firstOrFail();

        $task->delete();
    }
}
