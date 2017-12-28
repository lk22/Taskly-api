<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Taskly\User;
use Taskly\Task;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /**
     * @todo hit_tasks_api
     * @test
     */
    public function hit_tasks_api()
    {
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

        $task = $this->make(Task::class, ['user_id' => 1]);
        $this->get(route('task.single.api', [$task->slug]))
             ->assertStatus(200);
    }

    /**
     * @todo test the json structure for a task
     * @test
     */
    public function assert_tasks_json_structure_from_api()
    {

        $task = $this->make(Task::class, [
            'name' => 'task1',
            'slug' => 'task-1',
            'user_id' => 1,
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

        $task = $this->make(Task::class, [
            'name' => 'task1',
            'slug' => 'task-1',
            'user_id' => 1,
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
    // public function assert_exact_json_response_from_tasks_api()
    // {
    //     $task = $this->make(Task::class, [
    //         'name' => 'task1',
    //         'slug' => 'task-1',
    //         'user_id' => 1,
    //         'task_list_id' => 1,
    //         'is_checked' => true,
    //         'work_hours' => '4 timer',
    //         'start_at' => '2017-12-19 17:50:47',
    //         'end_at' => '2017-12-19 15:50:47',
    //         'priority' => 'High priority'
    //     ]);

    //     $this->json('GET', route('task.single.api', [$task->slug]))
    //           ->assertExactJson([
    //             'data' => [
    //                 'id' => $task->id,
    //                 'name' => 'task1',
    //                 'slug' => 'task-1',
    //                 'is_checked' => true,
    //                 'end_at' => '2017-12-19 17:50:47',
    //                 'start_at' => '2017-12-19 15:50:47',
    //                 'priority' => 'High priority',
    //                 'work_hours' => '4 timer'
    //             ]
    //           ]);
    // }

    /**
     * @test
     */
    public function create_new_task_resource_with_default_priority()
    {
        $user = $this->make(User::class);

        $this->actingAs($user);

        $this->post(route('task.create.api'), [
            'name' => 'Pappresser',
            'priority' => 'No priority',
            'work_hours' => '1 time'
        ])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Pappresser',
            'slug' =>   'pappresser',
        ]);
    }

    /**
     * @test
     */
    public function create_new_task_resource_with_custom_set_priority()
    {
        $user = $this->make(User::class);

        $this->actingAs($user);

        $this->post(route('task.create.api'), [
            'name' => 'Pappresser',
            'priority' => 'Medium priority',
            'work_hours' => '1 time'
        ])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Pappresser',
            'slug' => 'pappresser',
            'user_id' => $user->id,
            'priority' => 'Medium priority'
        ]);
    }

    /**
     * @test
     * @todo: create a task with a custom set of work hours
     */
    public function create_task_resource_with_work_hours()
    {
        $user = $this->make(User::class);

        $this->actingAs($user);

        $this->post(route('task.create.api'), [
            'name' => 'Pappresser',
            'work_hours' => '3 timer',
            'priority' => 'Medium priority'
        ])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Pappresser',
            'slug' => 'pappresser',
            'work_hours' => '3 timer',
            'priority' => 'Medium priority'
        ]);
    }

    /**
     * @test
     */
    public function update_existing_task_resource()
    {
        $user = $this->make(User::class);

        $this->actingAs($user);


        $task = $this->make(Task::class, [
            'name' => 'Pappresser',
            'user_id' => $user->id,
            'slug' => 'pappresser'
        ]);

        $this->put(route('task.update.api', [$task->slug]), [
            'name' => 'Kolonial',
            'priority' => 'High priority',
            'work_hours' => '1 time'
        ])->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Kolonial',
            'slug' => 'kolonial',
            'priority' => 'High priority',
            'work_hours' => '1 time'
        ]);
    }

    /**
     * @test
     */
    public function delete_existing_task_resource()
    {
        $user = $this->make(User::class);

        $this->actingAs($user);

        $task = $this->make(Task::class, [
            'name' => 'Pappresser',
            'slug' => 'pappresser',
            'user_id' => $user->id
          ], 1);

        $this->delete(route('task.delete.api', [$task->slug]))->assertStatus(200);

        $this->assertDatabaseMissing('tasks', [
            'name' => $task->name,
            'slug' => $task->slug,
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

        $user = $this->make(User::class);

        $this->actingAs($user);

        $task = $this->make(Task::class, [
            'user_id' => $user->id,
            'priority' => 'No priority'
        ]);

        $this->patch(route('task.priority.api', [$task->slug]), [
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

        $user = $this->make(User::class);

        $this->actingAs($user);

        $task = $this->make(Task::class, [
            'user_id' => $user->id,
            'is_checked' => false
        ]);

        $this->patch(route('task.check.api', [$task->id]), [
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

        $user = $this->make(User::class);

        $this->actingAs($user);

        $tasks = $this->make(Task::class, [
            'user_id' => $user->id,
            'is_checked' => 0
        ], 2);

        $this->patch(route('task.checkAll.api'), [
            'check' => true
        ])->assertStatus(200);

        foreach ($tasks as $task) {
            $this->assertDatabaseHas('tasks', [
                'is_checked' => 1
            ]);
        }
    }

    /**
     * uncheck all tasks if they allready are checked
     * @test
     */
    public function uncheck_all_tasks_if_they_allready_are_checked()
    {

        $user = $this->make(User::class);

        $this->actingAs($user);

        $tasks = $this->make(Task::class, [
            'user_id' => $user->id,
            'is_checked' => 1
        ], rand(1, 4));

        $this->patch(route('task.uncheckAll.api'), [
            'check' => false
        ])->assertStatus(200);

        foreach ($tasks as $task) {
            $this->assertDatabaseHas('tasks', [
                'is_checked' => 0
            ]);
        }
    }
}
