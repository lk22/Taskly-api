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
    public function hit_tasks_api()
    {
        $this->withoutExceptionHandling();
        $this->get(route('tasks.api'))
              ->assertStatus(200);
    }

    /**
     * @description: hit_single_task_api_endpoint
     * @todo test client can hit single task api endpoint
     * @test
     */
    public function hit_single_task_api_endpoint()
    {
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
    public function assert_tasks_json_structure_from_api()
    {
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
    public function assert_tasks_json_fragments_from_api_call()
    {
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
    public function assert_exact_json_response_from_tasks_api()
    {
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

    /**
     * @test
     */
    public function create_new_task_resource_with_default_priority()
    {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class);

        $this->actingAs($user);

        $tasklist = $this->make(TaskList::class);

        $this->post(route('task.create.api', [$tasklist->slug]), [
            'name' => 'Pappresser',
        ])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Pappresser',
            'slug' =>   'pappresser',
            'task_list_id' => $tasklist->id,
        ]);
    }

    /**
     * @test
     */
    public function update_existing_task_resource()
    {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class);

        $this->actingAs($user);

        $tasklist = $this->make(TaskList::class);

        $task = $this->make(Task::class, [
            'name' => 'Pappresser',
            'task_list_id' => $tasklist->id,
            'user_id' => $user->id,
            'slug' => 'pappresser'
        ]);

        $this->post(route('task.update.api', [$tasklist->slug, $task->slug]), ['name' => 'Kolonial'])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Kolonial',
            'slug' => 'kolonial'
        ]);
    }

    /**
     * @test
     */
    public function delete_existing_task_resource()
    {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class);

        $this->actingAs($user);

        $tasklist = $this->make(TaskList::class);

        $task = $this->make(Task::class, ['name' => 'Pappresser', 'slug' => 'pappresser', 'task_list_id' => $tasklist->id, 'user_id' => $user->id], 1);

        $this->post(route('task.delete.api', [$tasklist->slug, $task->slug]))->assertStatus(200);

        $this->assertDatabaseMissing('tasks', [
            'name' => $task->name,
            'slug' => $task->slug,
            'task_list_id' => $tasklist->id,
            'user_id' => $user->id
        ]);
    }

    // @todo test client can create task with priority set

    /**
     * @description: set_priority_to_task
     * @todo
     * @test
     */
    public function set_priority_to_task()
    {
        $this->withoutExceptionHandling();

        $tasklist = $this->make(Tasklist::class);

        $task = $this->make(Task::class, [
            'task_list_id' => $tasklist->id,
            'priority' => 'No priority'
        ]);

        $this->post(route('task.priority.api', [$task->slug]), [
            'priority' => 'High priority'
        ])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'priority' => 'High priority'
        ]);
    }

    /**
     * @description: check_out_task
     * @todo create a check for a task
     * @test
     */
    public function tooggle_task_check()
    {
        $this->withoutExceptionHandling();

        $tasklist = $this->make(Tasklist::class);

        $task = $this->make(Task::class, [
            'task_list_id' => $tasklist->id,
            'is_checked' => false
        ]);

        $this->post(route('task.check.api', [$task->id]), [
            'check' => 1
        ])->assertStatus(200);
    }

    /**
     * @description: checkout_all_tasks
     * @todo checkout all tasks from tasklist
     * @test
     */
    public function checkout_all_tasks()
    {
        $this->withoutExceptionHandling();

        $tasklist = $this->make(Tasklist::class);

        $tasks = $this->make(Task::class, [
            'task_list_id' => $tasklist->id,
            'is_checked' => 0
        ], 2);

        $this->post(route('task.checkAll.api'), [
            'check' => true
        ])->assertStatus(200);

        foreach ($tasks as $task) {
            $this->assertDatabaseHas('tasks', [
                'is_checked' => 0
            ]);
        }
    }
}
