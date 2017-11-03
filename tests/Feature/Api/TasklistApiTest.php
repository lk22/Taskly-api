<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Taskly\User;
use Taskly\TaskList;
use Taskly\Task;

class TasklistApiTest extends TestCase
{
    use RefreshDatabase;

	/**
	 * @todo hit the tasklists api
	 * @test
	 */
	public function hit_tasklists_api(){
		$this->withoutExceptionHandling();
		$this->get(route('tasklists.api'))
			  ->assertStatus(200);
	}

	/**
	 * @description: hit_tasklists_tasks_api_enpoint
	 * @todo test client to hit tasklists tasks enpoint
	 * @test
	 */
	public function hit_tasklists_tasks_api_enpoint() {
		$this->withoutExceptionHandling();
		$this->get(route('tasklists.tasks.api'))
			 ->assertStatus(200);
	}

	/**
	 * @todo test the json structure for tasklists api
	 * @test
	 */
	public function assert_tasklists_json_structure_from_api() {
		$this->withoutExceptionHandling();

		$user = $this->make(User::class);

		$tasklist = $this->make(TaskList::class, [
			'name' => 'tasklist1',
			'slug' => 'tasklist-1',
			'user_id' => $user->id
		]);

		$this->json('GET', route('tasklist.single.api', [$tasklist->slug]))
			  ->assertJsonStructure([
			  	'data' => [
			  		'id',
			  		'name',
			  		'slug',
			  	]
			]);
	}

	/**
	 * @description: assert_json_structure_for_tasklists_and_tasks_api
	 * @todo
	 * @test
	 */
	public function assert_json_structure_for_tasklists_and_tasks_api() {
		$this->withoutExceptionHandling();

		$user = $this->make(User::class);

		$tasklist = $this->make(TaskList::class, [
			'name' => 'tasklist1',
			'slug' => 'tasklist-1',
			'user_id' => $user->id
		]);

		$task = $this->make(Task::class, [
			'name' => 'task1',
			'slug' => 'task-1',
			'user_id' => $user->id,
			'task_list_id' => $tasklist->id,
			'is_checked' => true
 		]);

 		// dd($tasklist->with('tasks')->get()->toArray());

 		$this->json('GET', route('tasklists.tasks.api'))
 			 ->assertJsonStructure([
 			 	'data' => [
 			 		'*' => [
						'id',
						'name',
						'slug',
						'tasks_count',
						'tasks' => [
							'data' => [
								'*' => [
									'id',
									'name',
									'slug'
								]
							]
						]
 			 		]
 			 	]
 			 ]);
	}

	/**
	 * @todo assert the json fragments are correct from tasklists api
	 * @test
	 */
	public function assert_tasklists_json_fragments_from_api_call() {
		$this->withoutExceptionHandling();

		$tasklist = $this->make(TaskList::class, [
			'name' => 'tasklist1',
			'slug' => 'tasklist-1',
			'user_id' => 1
		]);

		$this->json('GET', route('tasklist.single.api', [$tasklist->slug]))
		      ->assertJsonFragment([
				'name' => 'tasklist1',
				'slug' => 'tasklist-1',
		      ]);
	}

	/**
	 * @todo assert the exact json response is correct
	 * @test
	 */
	public function assert_exact_json_response_from_tasklists_api() {
		$this->withoutExceptionHandling();

		$tasklist = $this->make(TaskList::class, [
			'name' => 'tasklist1',
			'slug' => 'tasklist-1',
			'user_id' => 1
		]);

		$this->json('GET', route('tasklist.single.api', [$tasklist->slug]))
		      ->assertExactJson([
		      	'data' => [
		      		'id' => $tasklist->id,
		      		'name' => 'tasklist1',
					'slug' => 'tasklist-1',
		      	]
 		      ]);
	}
}
