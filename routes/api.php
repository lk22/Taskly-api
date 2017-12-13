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

\Auth::loginUsingId(1);

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
Route::get('/users')->name('users.api')->uses('UserController@index');
Route::get('/users/tasklists')->name('users.tasklists.api')->uses('UserController@usersTasklists');
Route::get('/user/{user_slug}')->name('user.single.api')->uses('UserController@user');
Route::get('/user/{user_slug}/tasklists')->name('user.tasklists.api')->uses('UserController@userTasklists');
Route::get('/user/{user_slug}/tasklists/tasks')->name('users.tasklists.tasks.api')->uses('UserController@userTasklistsTasks');
// Route::post('/user/create')->name('user.create.api')->uses('UserController@create');


// user auth routes
Route::post('/login')->name('login.api')->uses('UserController@login');
Route::post('/register')->name('register.api')->uses('UserController@register');

/**
 * Tasklists API Endpoints
 */
Route::get('/tasklists')->name('tasklists.api')->uses('TasklistController@index');
Route::get('/tasklists/tasks')->name('tasklists.tasks.api')->uses('TasklistController@tasklistsTasks');
Route::get('/tasklists/{list_slug}')->name('tasklist.single.api')->uses('TasklistController@tasklist');
Route::post('/tasklists/create-tasklist')->name('tasklist.create.api')->uses('TasklistController@create');
Route::put('/tasklists/{slug}/update-tasklist')->name('tasklist.update.api')->uses('TasklistController@update');
Route::delete('/tasklists/{id}/delete-tasklist')->name('tasklist.delete.api')->uses('TasklistController@destroy');

/**
 * Task API Endpoints
 */
Route::prefix('/tasklists/{list_slug}/tasks')->group(function () {
    Route::post('/create-task')->name('task.create.api')->uses('TaskController@create');
});

 Route::get('/tasks')->name('tasks.api')->uses('TaskController@index');
 Route::get('/tasks/{slug}')->name('task.single.api')->uses('TaskController@task');
 Route::patch('/tasks/{slug}/set-priority')->name('task.priority.api')->uses('TaskController@setPriority');
 Route::patch('/tasks/{slug}/set-workhour')->name('task.workhour.api')->uses('TaskController@setWorkHour');
 Route::patch('/tasks/{id}/checkout-task')->name('task.check.api')->uses('TaskController@toggleTaskCheck');
 Route::patch('/tasks/check-all')->name('task.checkAll.api')->uses('TaskController@checkAllTasks');
 Route::patch('/tasks/uncheck-all')->name('task.uncheckAll.api')->uses('TaskController@uncheckALlTasks');
 Route::put('/tasks/{slug}/update-task')->name('task.update.api')->uses('TaskController@update');
 Route::delete('/tasks/{slug}/delete-task')->name('task.delete.api')->uses('TaskController@delete');

/**
 * Placement API Endpoints
 */
Route::get('/placements')->name('placements.api')->uses('PlacementController@index');
Route::get('placements/{slug}')->name('placement.single.api')->uses('PlacementController@placement');
