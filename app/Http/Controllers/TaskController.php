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
use Taskly\Comment;

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
    public function __construct(Task $task, Comment $comment)
    {
        $this->task          = $task;
        $this->comment       = $comment;

        $this->authenticated = \Auth::guard('api')->user();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching all tasks from a tasklist
     * |------------------------------------------------------------------------
     */
    public function index()
    {

        $tasks = $this->task->where('user_id', $this->authenticated->id)->get();


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
        $task = $this->task->whereSlug($slug)
                ->orWhere('user_id', $this->authenticated->id)
                ->firstOrFail();

        if (!count($task) > 0) {
            return API::throwResourceNotFoundException();
        }

        return fractal($task, new TaskTransformer())->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Set new custom comment to a specifc task
     * |------------------------------------------------------------------------
     */
    public function setComment(Request $request, $slug)
    {
        // validate request params
        API::validate($request, [ 'body', 'required' ]);

        // check if comment body exists in param bag
        if( !$request->has('body') ){
            return API::throwInputNotFoundException();
        }

        // fetch the task to comment
        $task = $this->task->whereSlug($slug)->firstOrFail();

        // create the comment instance with the given body from request
        $comment = new Comment(['body' => $request->get('comment')]);

        // save the comment
        $task->comments()->save($comment);
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
            return API::throwInputNotFoundException();
        }

        $this->task->whereId($id)->update([ 'is_checked' => $request->get('check') ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    check all tasks
     * |------------------------------------------------------------------------
     */
    public function checkAllTasks(Request $request)
    {
        API::validate($request,[ 'check' => '' ]);

        if (!$request->get('check')) {
            return API::throwInputNotFoundException();
        }

        $this->task->whereIsChecked(false)->update([ 'is_checked' => $request->get('check') ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Uncheck all tasks on the tasklist
     * |------------------------------------------------------------------------
     */
    public function uncheckAllTasks(Request $request)
    {
        API::validate($request ,[ 'check' => '' ]);

        if (!$request->get('check')) {
            return API::throwInputNotFoundException();
        }

        $this->task->whereIsChecked(true)->update([ 'is_checked' => $request->get('check') ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Create new task resource
     * |------------------------------------------------------------------------
     */
    public function create(Request $request)
    {

        API::validate($request, [
            'work_hours'    => 'required',
            'location'      => 'required',
            'supplier'      => 'required',
            'week_day'      => 'required',
            'week'          => 'required'
        ]);

        $task = $this->task->create([
            'location'      => $request->get('location'),
            'slug'          => str_replace(' ', '-', strtolower($request->get('location'))),
            'week_day'      => $request->get('week_day'),
            'week'          => $request->get('week'),
            'user_id'       => $this->authenticated->id,
            'supplier'      => $request->get('supplier'),
            'work_hours'    => $request->get('work_hours') . ($request->get('work_hours') === '1') ? 'time' : 'timer',
        ]);

        if($task) {
            return API::throwActionSuccessResponse('Task created successfully');
        }

        if( $request->get('comment') ) {
            $comment = new Comment(['body' => $request->get('comment')]);

            $task->comments()->save($comment);
        }
    }

    /**
     * |------------------------------------------------------------------------
     * |    Update existing task resource
     * |------------------------------------------------------------------------
     */
    // public function update(Request $request, $slug)
    // {
    //     API::validate($request, [
    //         'name' => 'required',
    //         'priority' => '',
    //         'work_hours' => 'required'
    //     ]);

    //     $task = $this->task->whereSlug($slug)->firstOrFail();

    //     $task->update([
    //         //'name' => preg_match("/^[a-zA-Z0-9ÆØÅæøå]+$/i^", $request->get('name')),
    //         'name' => $request->get('name'),
    //         'priority' => $request->get('priority'),
    //         'slug' => str_replace('-', ' ', strtolower($request->get('name'))),
    //         'work_hours' => $request->get('work_hours')
    //     ]);
    // }

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
