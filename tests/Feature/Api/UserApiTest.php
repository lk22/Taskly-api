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
                    'fullname',
                    'slug',
                    'email',
                    'company' => [
                            '*' => [
                                'company_name',
                                'company_type',
                                'company_address',
                                'company_registration_nr',
                                'company_phone_nr'
                            ]
                        ],
                        'tasks' => [
                            '*' => [
                                'id',
                                'name',
                                'slug',
                                'is_checked',
                                'work_hours',
                                'priority',
                                'start_at',
                                'end_at',
                                'deadline',
                                'supplier'
                            ]
                        ]
                ]
        ]);
    }

    /**
     * @description: assert_user_companies_json_structure
     * @todo 
     * @test
     */
    public function assert_user_companies_json_structure() {
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
             ]);
    }
}
