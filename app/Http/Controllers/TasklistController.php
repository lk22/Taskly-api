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

    /**
     * triggering ascending tasklists
     * @return [type] [description]
     */
    public function ascendingTasklists()
    {
        return fractal(
            $this->tasklist->ascending()->with('tasks')->get(),
            new TaskListsTransformer()
        )->toArray();
    }

    /**
     * create new tasklist resource
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $request->validate([
            'name' => 'required'
        ]);

        if (!$request->all()) {
            return response()->json([
                'error' => 'Something went wrong creating your resource'
            ]);
        }

        try {
            $this->tasklist->create([
                'name' => $request->get('name'),
                'slug' => strtolower($request->get('name')),
                'user_id' => $user->id
            ]);
        } catch (BadMethodCallException $e) {
            return $e;
        }
    }

    /**
     * updating existing resource
     * @param  Request $request [description]
     * @param  [type]  $slug    [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $slug)
    {
        $user = \Auth::user();

        $tasklist = $this->tasklist->whereSlug($slug)->firstOrFail();

        try {
            $tasklist->update([
                'name' => $request->get('name'),
                'slug' => strtolower($request->get('name')),
            ]);
        } catch (BadMethodCallException $e) {
            return $e;
        }
    }

    /**
     * Destroying existing resource
     */
    public function destroy(Request $request, $id)
    {
        $tasklist = $this->tasklist->whereId($id)->firstOrFail();

        try {
            $tasklist->delete();
        } catch (BadMethodCallException $e) {
            return $e;
        }
    }
}
