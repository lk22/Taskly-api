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

        $users = $user->all();

        $this->assertCount(3, $users);
    }

    /**
     * @description: get_single_user
     * @todo fetch single user
     * @test
     */
    public function get_single_user() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class);

        $singleUser = $user->whereSlug($user->slug)->get()->toArray();

        $this->assertCount(1, $singleUser);
    }

    /**
     * @description: create_new_user_resource_test
     * @todo 
     * @test
     */
    // public function create_new_user_resource_test() {
    //     $this->withoutExceptionHandling();

    //     $user = $this->make(User::class);

    //     $this->get(route('user.create.api'), [
    //         'firstname' => $user->firstname,
    //         'lastname' => $user->lastname,
    //         'email' => $user->email,
    //         'password' => bcrypt($user->password),
    //     ])->assertStatus(200);

    //     $this->assertDatabaseHas('users', [
    //         'id' => $user->id,
    //         'firstname' => $user->firstname,
    //         'lastname' => $user->lastname,
    //         'name' => $user->name,
    //         'slug' => strtolower($user->firstname) . '-' . strtolower($user->lastname),
    //         'email' => $user->email,
    //         'password' => $user->password,
    //         'is_admin' => "0",
    //         'remember_token' => null,
    //     ]);
    // }
}
