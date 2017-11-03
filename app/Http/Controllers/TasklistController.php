<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;
// use Taskly\Http\Resources\TasklistCollection;
// use Taskly\Http\Resources\TasklistResource;

use Taskly\Transformers\TaskListTransformer;
use Taskly\Transformers\TaskListsTransformer;

use Taskly\TaskList;

class TasklistController extends Controller
{
    /**
     * Constructor
     * @param Tasklist $tasklist [description]
     */
    public function __construct(Tasklist $tasklist)
    {
    	$this->tasklist = $tasklist;
    }

    /**
     * fetching all tasks from api
     * @return [type] [description]
     */
    public function index()
    {
    	return fractal(
            $this->tasklist->all(),
            new TaskListsTransformer()
        )->toArray();
    }

    /**
     * fetching a specific task from a slug
     * @param  [type] $list_slug [description]
     * @return [type]            [description]
     */
    public function tasklist($list_slug)
    {
    	return fractal(
            $this->tasklist->whereSlug($list_slug)->first(),
            new TaskListTransformer()
        )->toArray();
    }

    /**
     * fetch tasklists with all the expected tasks each list contains
     * @return [type] [description]
     */
    public function tasklistsTasks()
    {
        return fractal(
            $this->tasklist->with('tasks')->get(),
            new TaskListsTransformer()
        )->toArray();
    }

}
