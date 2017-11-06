<?php

namespace Tests\Feature\Unit\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Taskly\User;
use Taskly\Tasklist;
use Taskly\Task;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: get_all_users_test
     * @todo 
     * @test
     */
    public function get_all_users_test() {
    	$this->withoutExceptionHandling();

    	$user = $this->make(User::class, [], 3);

    	$mock = \Mockery::mock(User::class);
    	$mock->shouldReceive('all')->andReturn(User::all());


    }
}
