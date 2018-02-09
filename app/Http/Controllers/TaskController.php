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
        // fetch all users tasks
        $tasks = $this->task->where('user_id', $this->authenticated->id)->get();

        // get all the taskss
        if (count($tasks) >= 0) {
            return fractal($tasks, new TaskTransformer())->toArray();
        }

        // throw exception
        return API::throwResourceNotFoundException();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching a single tasks from a tasklist
     * |------------------------------------------------------------------------
     */
    public function task($slug)
    {
        // fetch single task
        $task = $this->task->whereSlug($slug)
                ->orWhere('user_id', $this->authenticated->id)
                ->firstOrFail();

        // if the task not is found
        if (!count($task) > 0) {
            return API::throwResourceNotFoundException();
        }

        // return task
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
        // validate request
        API::validate($request, [ 'check' => '' ]);

        // if check param not exists throw exception
        if (!$request->get('check')) {
            return API::throwInputNotFoundException();
        }

        // update task with request value
        $this->task->whereId($id)->update([ 'is_checked' => $request->get('check') ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    check all tasks
     * |------------------------------------------------------------------------
     */
    public function checkAllTasks(Request $request)
    {
        // validate request
        API::validate($request,[ 'check' => '' ]);

        // if the check param not exists
        if (!$request->get('check')) {
            return API::throwInputNotFoundException();
        }

        // update task with the request param
        $this->task->whereIsChecked(false)->update([ 'is_checked' => $request->get('check') ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Uncheck all tasks on the tasklist
     * |------------------------------------------------------------------------
     */
    public function uncheckAllTasks(Request $request)
    {
        // validate request
        API::validate($request ,[ 'check' => '' ]);

        // if the request not has the check param throw exception
        if (!$request->get('check')) {
            return API::throwInputNotFoundException();
        }

        // else then update the tasks to be checked
        $this->task->whereIsChecked(true)->update([ 'is_checked' => $request->get('check') ]);
    }

    /**
     * |------------------------------------------------------------------------
     * |    Create new task resource
     * |------------------------------------------------------------------------
     */
    public function create(Request $request)
    {

        // validate request
        API::validate($request, [
            'work_hours'    => 'required',
            'location'      => 'required',
            'supplier'      => 'required',
            'week_day'      => 'required',
            'week'          => 'required'
        ]);

        // create the resource to the database
        $task = $this->task->create([
            'location'      => $request->get('location'),
            'slug'          => str_replace(' ', '-', strtolower($request->get('location'))),
            'week_day'      => $request->get('week_day'),
            'week'          => $request->get('week'),
            'user_id'       => $this->authenticated->id,
            'supplier'      => $request->get('supplier'),
            'work_hours'    => $request->get('work_hours') . ' timer'
        ]);

        // if the task is stored successfully throw back response
        if($task) {
            return API::throwResourceCreatedResponse($task->slug);
        }

        // if the request has comment in param bag save the comment
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
