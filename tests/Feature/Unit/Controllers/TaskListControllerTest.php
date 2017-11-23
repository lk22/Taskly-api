<?php

namespace Tests\Feature\Unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \Taskly\TaskList;

class TaskListControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * description: test the tasklist sorting action
     * @test
     */
    public function test_sorting_tasklists()
    {
        $this->make(TaskList::class, [], 2);

        $taskList = new Tasklist;

        $this->assertCount(2, $taskList->with('tasks')->ascending()->get());
    }
}
