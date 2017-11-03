<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Taskly\User;
use Taskly\TaskList;
use Taskly\Task;

class TaskApiTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @todo hit_tasks_api
	 * @test
	 */
	public function hit_tasks_api(){
		$this->withoutExceptionHandling();
		$this->get(route('tasks.api'))
			  ->assertStatus(200);
	}

	/**
	 * @description: hit_single_task_api_endpoint
	 * @todo test client can hit single task api endpoint
	 * @test
	 */
	public function hit_single_task_api_endpoint() {
		$this->withoutExceptionHandling();
		$tasklist = $this->make(TaskList::class);
		$task = $this->make(Task::class);
		$this->get(route('task.single.api', [$task->slug]))
			 ->assertStatus(200);
	}

	/**
	 * @todo test the json structure for a task
	 * @test
	 */
	public function assert_tasks_json_structure_from_api() {
		$this->withoutExceptionHandling();

		$task = $this->make(Task::class, [
			'name' => 'task1',
			'slug' => 'task-1',
			'user_id' => 1,
			'task_list_id' => 1
		]);

		$this->json('GET', route('task.single.api', [$task->slug]))
			  ->assertJsonStructure([
				'data' => [
					'id',
					'name',
					'slug'
				]
			]);
	}

	/**
	 * @todo test specific json fragments for a task
	 * @test
	 */
	public function assert_tasks_json_fragments_from_api_call() {
		$this->withoutExceptionHandling();

		$task = $this->make(Task::class, [
			'name' => 'task1',
			'slug' => 'task-1',
			'user_id' => 1,
			'task_list_id' => 1,
			'is_checked' => true
		]);

		$this->json('GET', route('task.single.api', [$task->slug]))
		      ->assertJsonFragment([
				'name' => 'task1',
				'slug' => 'task-1',
				'is_checked' => true
		      ]);
	}

	/**
	 * @todo test the exact json response
	 * @test
	 */
	public function assert_exact_json_response_from_tasks_api() {
		$this->withoutExceptionHandling();

		$task = $this->make(Task::class, [
			'name' => 'task1',
			'slug' => 'task-1',
			'user_id' => 1,
			'task_list_id' => 1,
			'is_checked' => true
		]);

		$this->json('GET', route('task.single.api', [$task->slug]))
		      ->assertExactJson([
				'data' => [
					'id' => $task->id,
					'name' => 'task1',
					'slug' => 'task-1',
					'is_checked' => true
				]
		      ]);
	}
}
