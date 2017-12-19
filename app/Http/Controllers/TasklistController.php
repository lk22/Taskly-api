<?php

namespace Taskly\Http\Controllers;

/**
 * Illuminate packages
 */
use Illuminate\Http\Request;

/**
 * Fractal transformers
 */
use Taskly\Transformers\TaskListTransformer;
use Taskly\Transformers\TaskListsTransformer;

/**
 * Eloquent models
 */
use Taskly\TaskList;

/**
 * Taskly API Helper
 * @var [type]
 */
use Taskly\Helpers\API\API;

class TasklistController extends Controller
{
    /**
     * |------------------------------------------------------------------------
     * |    Constructor
     * |    @param: \Taskly\Tasklist $tasklist
     * |------------------------------------------------------------------------
     */
    public function __construct(Tasklist $tasklist)
    {
        $this->tasklist = $tasklist;
        $this->authenticated = \Auth::user();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Fetching all tasks from a tasklists
     * |------------------------------------------------------------------------
     */
    public function index()
    {
        $tasklists = $this->tasklist->all();

        if (!$tasklists) {
            
            return API::throwResourceNotFoundException();   
        }
        
        return fractal($tasklists, new TaskListsTransformer())->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |   fetching a specific task from a slug
     * |------------------------------------------------------------------------
     */
    public function tasklist($list_slug)
    {
        $tasklist = $this->tasklist->whereSlug($list_slug)->first();

        if (!count($tasklist)) {
            return API::throwResourceNotFoundException();
        }

        return fractal($tasklist, new TaskListTransformer())->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    fetch tasklists with all the expected tasks each list contains
     * |------------------------------------------------------------------------
     */
    public function tasklistsTasks()
    {
        $tasklistsWithTasks = $this->tasklist->with('tasks')->get();

        if (!count($tasklistsWithTasks) >= 0) {
            
            return fractal($tasklistsWithTasks, new TaskListsTransformer())->toArray();
        }

        return API::throwResourceNotFoundException();
    }

    /**
     * |------------------------------------------------------------------------
     * |   make a ascending order on the tasklists
     * |------------------------------------------------------------------------
     */
    public function ascendingTasklists()
    {
        return fractal(
            $this->tasklist->ascending()->with('tasks')->get(),
            new TaskListsTransformer()
        )->toArray();
    }

    /**
     * fetch descending ordered tasklists
     * @return [type] [description]
     */
    /**
     * |------------------------------------------------------------------------
     * |    making descending order for tasklists resources
     * |------------------------------------------------------------------------
     */
    public function descendingTasklists()
    {
        return fractal(
            $this->tasklist->descending()->with('tasks')->get(),
            new TaskListTransformer()
        )->toArray();
    }

    /**
     * |------------------------------------------------------------------------
     * |    Set custom priority to a task
     * |    @param Request $request the request Object
     * |    @return void
     * |------------------------------------------------------------------------
     */
    public function create(Request $request)
    {
        // API::validate($request, [
        //     'name' => 'required'
        // ]);

        if($request->get('name')) {
            $this->tasklist->create([
                'name' => $request->get('name'),
                'slug' => strtolower($request->get('name')),
                'user_id' => auth()->user()->id
            ]);
        }

        if(!$request->get('name')){
            return API::throwActionFailedException(
                'Could not continue with your request'
            );
        }
    }

    /**
     * |------------------------------------------------------------------------
     * |    Update existing tasklist resource
     * |    @param  Request $request \Illuminate\Http\Request
     * |    @param  slug $slug the tasklist slug
     * |------------------------------------------------------------------------
     */
    public function update(Request $request, $slug)
    {
        $tasklist = $this->tasklist->whereSlug($slug)->firstOrFail();

        try {
            $tasklist->update([
                'name' => $request->get('name'),
                'slug' => strtolower($request->get('name')),
            ]);

            return API::throwActionSuccessResponse('Your Tasklist is updated from successfully');
        } catch (BadMethodCallException $e) {
            return API::throwActionFailedException($e);
        }
    }

    /**
     * |------------------------------------------------------------------------
     * |    Destrying existing resource
     * |    @param  Request $request \Illuminate\Http\Request
     * |------------------------------------------------------------------------
     */
    public function destroy(Request $request, $id)
    {
        $tasklist = $this->tasklist->whereId($id)->firstOrFail();
        $tasklist->delete();

        return API::throwActionSuccessResponse('Tasklist is removed from your list');
    }
}
