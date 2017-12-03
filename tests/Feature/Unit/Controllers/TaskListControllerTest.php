<?php

namespace Tests\Feature\Unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \Taskly\TaskList;
use \Taskly\User;

class TaskListControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: test_if_no_resources_exists_throw_a_api_exception
     * @todo 
     * @test
     */
    public function test_if_no_resources_exists_throw_a_api_exception() {
        $this->withoutExceptionHandling();

        $response = $this->get(route('tasklists.api'));

        $response->assertStatus(404);
        $response->assertSee("Your request dosen't contain any resources");
    }

    /**
     * @description: test_if_name_field_is_not_request
     * @todo 
     * @test
     */
    public function test_if_name_field_is_not_in_post_request() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class);

        $this->actingAs($user);

        $response = $this->post(route('tasklist.create.api'), ['name' => '']);

        $response->assertStatus(422);

    }

    /**
     * description: test the tasklist sorting action
     * @test
     */
    public function test_sorting_tasklists_ascending()
    {
        $this->make(TaskList::class, [], 2);

        $taskList = new Tasklist;

        $this->assertCount(2, $taskList->with('tasks')->ascending()->get());
    }

    /**
     * @description sort tasklists descendingly
     * @test
     */
    public function test_sorting_tasklists_descending()
    {
        $this->make(TaskList::class, [], 2);

        $taskList = new TaskList;

        $this->assertCount(2, $taskList->with('tasks')->descending()->get());
    }
}
