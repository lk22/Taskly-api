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

	// user authentication routes
	Route::post('/login')->name('login.api')->uses('UserController@login');
	Route::post('/register')->name('register.api')->uses('UserController@register');

	Route::get('/', function () {
	    return response()->json([
	        'response' => 'success'
		]);
	});

	/**
	 * users API Endpoints
	 */

		// all users
		Route::get('/user', function (Request $request) {
	    	return $request->user();
		});

		/**
		 * Authenticated user
		 */
		Route::get('/auth')
			 ->name('user.auth.api')
			 ->uses('UserController@auth');

		/**
		 * Update user information
		 */
		Route::post('/user/{slug}/settings/update-user-information')
			 ->name('user.settings.set-user-information')
			 ->uses('UserController@updateUserInformation');

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

		// set new comment
		Route::patch('/task/{slug}/set-comment')
			 ->name('task.set-comment.api')
			 ->uses('TaskController@setComment');

		// update the task
		// Route::put('/tasks/{slug}/update-task')
		// 	 ->name('task.update.api')
		// 	 ->uses('TaskController@update');

		// delete the task
		Route::delete('/tasks/{slug}/delete-task')
			 ->name('task.delete.api')
			 ->uses('TaskController@delete');
