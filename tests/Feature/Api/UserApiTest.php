<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Taskly\User;
use Taskly\Task;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: hit_users_api_endpoint
     * @todo test client to hit users api endpoint
     * @test
     */
    public function hit_users_api_endpoint() {
    	$this->withoutExceptionHandling();
    	$this->get(route('users.api'))->assertStatus(200);
    }

    /**
     * @description: hit_single_user_api_endpoint
     * @todo test client to hit user api endpoint
     * @test
     */
    public function hit_single_user_api_endpoint() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class, [
            'firstname' => 'Leo',
            'lastname' => 'Knudsen',
            'name' => 'Leo Knudsen',
            'slug' => 'leo-knudsen',
            'email' => 'knudsenudvikling@gmail.com',
            'password' => bcrypt('test'),
            'is_admin' => true
        ]);


        $this->get(route('user.single.api', [$user->slug]))
             ->assertStatus(200);
    }

    /**
     * @description: hit_users_tasklists_api_endpoint
     * @todo test client to hit endpoint to show a user with a tasklist
     * @test
     */
    public function hit_users_tasklists_api_endpoint() {
        $this->withoutExceptionHandling();
        $this->get(route('users.tasks.api'))
             ->assertStatus(200);
    }

    /**
     * @description: hit_users_tasklists_tasks_api_endpoint
     * @todo test client to hit endpoint to show a user with tasklists with tasks in it
     * @test
     */
    public function hit_users_tasklists_tasks_api_endpoint() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class, [
            'firstname' => 'Leo',
            'lastname' => 'Knudsen',
            'name' => 'Leo Knudsen',
            'slug' => 'leo-knudsen',
            'email' => 'knudsenudvikling@gmail.com',
            'password' => bcrypt('test'),
            'is_admin' => true
        ]);

        $task = $this->make(Task::class, [
            'name' => 'task1',
            'slug' => 'task-1',
            'user_id' => $user->id
        ]);

        $this->get(route('users.tasks.api', [$user->slug]))
             ->assertStatus(200);
    }

    /**
     * @description: get_single_user_from_api
     * @todo test json structure for a user
     * @test
     */
    public function get_single_user_from_api_and_assert_json_structure() {
        $this->withoutExceptionHandling();
    	$user = $this->make(User::class, [
    		'firstname' => 'Leo',
    		'lastname' => 'Knudsen',
    		'name' => 'Leo Knudsen',
    		'slug' => 'leo-knudsen',
    		'email' => 'knudsenudvikling@gmail.com',
    		'password' => bcrypt('test'),
    		'is_admin' => true
    	]);

    	$this->json('GET', route('user.single.api', [$user->slug]))
             ->assertStatus(200)
             ->assertJsonStructure([
                'data' => [
                    'firstname',
                    'lastname',
                    'slug',
                    'email',
                    'is_admin'
                ]
        ]);
    }

    /**
     * @description: assert_users_tasklists_json_structure
     * @todo test the json structure for a users tasklist
     * @test
     */
    public function assert_users_tasklists_json_structure() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class, [
            'firstname' => 'Leo',
            'lastname' => 'Knudsen',
            'name' => 'Leo Knudsen',
            'slug' => 'leo-knudsen',
            'email' => 'knudsenudvikling@gmail.com',
            'password' => bcrypt('test'),
            'is_admin' => true
        ]);

        $this->json('GET', route('users.tasks.api'))
             ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'firstname',
                        'lastname',
                        'fullname',
                        'email',
                        'is_admin',
                    ]
                ]
             ]);
    }

    /**
     * @description: assert_users_tasks_json_structure
     * @todo test json structure for users, tasklists, tasks
     * @test
     */
    public function assert_users_tasks_json_structure() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class, [
            'firstname' => 'Leo',
            'lastname' => 'Knudsen',
            'name' => 'Leo Knudsen',
            'slug' => 'leo-knudsen',
            'email' => 'knudsenudvikling@gmail.com',
            'password' => bcrypt('test'),
            'is_admin' => true
        ]);

        $task = $this->make(Task::class, [
            'name' => 'task1',
            'slug' => 'task-1',
            'user_id' => $user->id,
        ], 2);

        // dd($user->with('tasklists.tasks')->get()->toArray());

        $this->json('GET', route('users.tasks.api', [$user->slug]))
             ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'firstname',
                        'lastname',
                        'fullname',
                        'email',
                        'is_admin',
                        'tasks' => [
                            'data' => [
                                '*' => [
                                    'id',
                                    'name',
                                    'slug',
                                    'is_checked'
                                ]
                            ]
                        ]
                    ]
                ]
             ]);
    }

    /**
     * @description: assert_json_fragments_from_api
     * @todo assert json fragments from json call
     * @test
     */
    public function assert_json_fragments_from_api() {
        $this->withoutExceptionHandling();

        $user = $this->make(User::class, [
            'firstname' => 'Leo',
            'lastname' => 'Knudsen',
            'name' => 'Leo Knudsen',
            'slug' => 'leo-knudsen',
            'email' => 'knudsenudvikling@gmail.com',
            'password' => bcrypt('test'),
            'is_admin' => true
        ]);

        $this->json('GET', route('user.single.api', [$user->slug]))
             ->assertJsonFragment([
                'firstname' => 'Leo',
                'lastname' => 'Knudsen',
                'fullname' => 'Leo Knudsen',
                'slug' => 'leo-knudsen',
                'email' => 'knudsenudvikling@gmail.com',
                'is_admin' => true
             ]);
    }

    /**
     * @description: assert_exact_json_from_users_api
     * @todo assert the correct json from api
     * @test
     */
    // public function assert_exact_json_from_users_api_without_tasks() {
    //     $this->withoutExceptionHandling();

    //     $user = $this->make(User::class, [
    //         'firstname' => 'Leo',
    //         'lastname' => 'Knudsen',
    //         'slug' => 'leo-knudsen',
    //         'email' => 'knudsenudvikling@gmail.com',
    //         'is_admin' => true
    //     ]);

    //     $this->json('GET', route('user.single.api', [$user->slug]))
    //          ->assertExactJson([
    //             'data' => [
    //                 'email' => 'knudsenudvikling@gmail.com',
    //                 'firstname' => 'Leo',
    //                 'fullname' => 'Leo Knudsen',
    //                 'id' => $user->id,
    //                 'is_admin' => true,
    //                 'lastname' => 'Knudsen',
    //                 'slug' => 'leo-knudsen',
    //                 'tasks' => [
    //                     'data' => [
    //                         '*' => []
    //                     ]
    //                 ]
    //             ]
    //          ]);
    // }
}
