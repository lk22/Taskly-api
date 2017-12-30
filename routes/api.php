<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth::loginUsingId(1);

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'response' => 'success'
    ]);
})->name('home.api');

// Route::get('/sql-tester', function (\Taskly\Tasklist $tasklist) {
//     $list = $tasklist->whereId(2)->whereHas('tasks', function ($task) use ($tasklist) {
//         $task->delete();
//     })->firstOrFail();
// });


// Route::post('/get-details')->uses('API\PassportController@getDetails');


/**
 * users API Endpoints
 */

	// all users
	Route::get('/users')
		 ->name('users.api')
		 ->uses('UserController@index');

	// all users tasks
	Route::get('/users/tasks')
		 ->name('users.tasks.api')
		 ->uses('UserController@usersTasks');

	// single user
	Route::get('/user/{user_slug}')
		 ->name('user.single.api')
		 ->uses('UserController@user');

	// single users task
	Route::get('/user/{user_slug}/tasks')
		 ->name('user.tasks.api')
		 ->uses('UserController@userTasks');

// user auth routes
// Route::post('/login')->name('login.api')->uses('UserController@login');
// Route::post('/register')->name('register.api')->uses('UserController@register');

/**
 * Tasks API Endpoints
 */

	// all tasks
	Route::get('/tasks')
		 ->name('tasks.api')
		 ->uses('TaskController@index');

	// single task
	Route::get('/tasks/{slug}')
		 ->name('task.single.api')
		 ->uses('TaskController@task');

	// create a task
	Route::post('/create-task')
		 ->name('task.create.api')
		 ->uses('TaskController@create');

	// update priority
	Route::patch('/tasks/{slug}/set-priority')
		 ->name('task.priority.api')
		 ->uses('TaskController@setPriority');

	// update work hours
	Route::patch('/tasks/{slug}/set-workhour')
		 ->name('task.workhour.api')
		 ->uses('TaskController@setWorkHour');

	// checkout the task
	Route::patch('/tasks/{id}/checkout-task')
		 ->name('task.check.api')
		 ->uses('TaskController@toggleTaskCheck');

	// check all tasks
	Route::patch('/tasks/check-all')
		 ->name('task.checkAll.api')
		 ->uses('TaskController@checkAllTasks');

	// uncheck all the tasks
	Route::patch('/tasks/uncheck-all')
		 ->name('task.uncheckAll.api')
		 ->uses('TaskController@uncheckALlTasks');

	// update the task
	Route::put('/tasks/{slug}/update-task')
		 ->name('task.update.api')
		 ->uses('TaskController@update');

	// delete the task
	Route::delete('/tasks/{slug}/delete-task')
		 ->name('task.delete.api')
		 ->uses('TaskController@delete');

// /**
//  * Placement API Endpoints
//  */
Route::get('/placements')->name('placements.api')->uses('PlacementController@index');
Route::get('placements/{slug}')->name('placement.single.api')->uses('PlacementController@placement');
