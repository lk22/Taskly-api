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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * users API Endpoints
 */
Route::get('/users')->name('users.api')->uses('UserController@index');
Route::get('/users/tasklists')->name('users.tasklists.api')->uses('UserController@usersTasklists');
Route::get('/user/{user_slug}')->name('user.single.api')->uses('UserController@user');
Route::get('/user/{user_slug}/tasklists')->name('user.tasklists.api')->uses('UserController@userTasklists');
Route::get('/user/{user_slug}/tasklists/tasks')->name('users.tasklists.tasks.api')->uses('UserController@userTasklistsTasks');

/**
 * Tasklists API Endpoints
 */
Route::get('/tasklists')->name('tasklists.api')->uses('TasklistController@index');
Route::get('/tasklists/tasks')->name('tasklists.tasks.api')->uses('TasklistController@tasklistsTasks');
Route::get('/tasklists/{list_slug}')->name('tasklist.single.api')->uses('TasklistController@tasklist');

/**
 * Task API Endpoints
 */
Route::get('/tasks')->name('tasks.api')->uses('TaskController@index');
Route::get('/tasks/{slug}')->name('task.single.api')->uses('TaskController@task');

/**
 * Placement API Endpoints
 */
Route::get('/placements')->name('placements.api')->uses('PlacementController@index');
Route::get('placements/{slug}')->name('placement.single.api')->uses('PlacementController@placement');