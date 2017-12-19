<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Fractal Transformers
 */
use Taskly\Transformers\TaskTransformer;

/**
 * Eloquent models
*/
use Taskly\Task;
use Taskly\TaskList;

/**
 * App helper classes
 */
use Taskly\Helpers\API\API;

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
        $tasks = $this->task->all();

        if (count($tasks) >= 0) {
            return fractal($tasks, new TaskTransformer())->toArray();
        }

        return API::throwResourceNotFoundException();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching a single tasks from a tasklist
     * |------------------------------------------------------------------------
     */
    public function task($slug)
    {
        $task = $this->task->whereSlug($slug)->firstOrFail();

        if (!count($task) > 0) {
            API::throwResourceNotFoundException();
        }

        return fractal($task, new TaskTransformer())->toArraY();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Set custom priority to a task
     * |------------------------------------------------------------------------
     */
    public function setPriority(Request $request, $slug)
    {
        API::validate($request, [
            'priority' => ''
        ]);

        if (!$request->get('priority')) {
            API::throwInputNotFoundException();
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
        API::validate($request, [ 'check' => '' ]);

        if (!$request->get('check')) {
            API::throwInputNotFoundException();
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
        API::validate($request,[
            'check' => ''
        ]);

        if (!$request->get('check')) {
            API::throwInputNotFoundException();
        }

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
        API::validate($request ,[
            'check' => ''
        ]);

        if (!$request->get('check')) {
            API::throwInputNotFoundException();
        }

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
        API::validate($request, [
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
        API::validate($request, [
            'name' => 'required',
            'priority' => '',
            'work_hours' => 'required'
        ]);

        $task = $this->task->whereSlug($slug)->firstOrFail();

        $task->update([
            //'name' => preg_match("/^[a-zA-Z0-9ÆØÅæøå]+$/i^", $request->get('name')),
            'name' => $request->get('name'),
            'priority' => $request->get('priority'),
            'slug' => str_replace('-', ' ', strtolower($request->get('name'))),
            'work_hours' => $request->get('work_hours')
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
