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
    // public function hit_users_api_endpoint() {
    // 	$this->withoutExceptionHandling();
    // 	$this->get(route('users.api'))->assertStatus(200);
    // }

    // /**
    //  * @description: assert_user_companies_json_structure
    //  * @todo 
    //  * @test
    //  */
    // public function assert_user_companies_json_structure() {
    //     $this->withoutExceptionHandling();

    //     $user = $this->make(User::class, [
    //         'firstname' => 'Leo',
    //         'lastname' => 'Knudsen',
    //         'name' => 'Leo Knudsen',
    //         'slug' => 'leo-knudsen',
    //         'email' => 'knudsenudvikling@gmail.com',
    //         'password' => bcrypt('test'),
    //         'is_admin' => true
    //     ]);

    // }

    // *
    //  * @description: assert_json_fragments_from_api
    //  * @todo assert json fragments from json call
    //  * @test
     
    // public function assert_json_fragments_from_api() {
    //     $this->withoutExceptionHandling();

    //     $user = $this->make(User::class, [
    //         'firstname' => 'Leo',
    //         'lastname' => 'Knudsen',
    //         'name' => 'Leo Knudsen',
    //         'slug' => 'leo-knudsen',
    //         'email' => 'knudsenudvikling@gmail.com',
    //         'password' => bcrypt('test'),
    //         'is_admin' => true
    //     ]);

    //     $this->json('GET', route('user.single.api', [$user->slug]))
    //          ->assertJsonFragment([
    //             'firstname' => 'Leo',
    //             'lastname' => 'Knudsen',
    //             'fullname' => 'Leo Knudsen',
    //             'slug' => 'leo-knudsen',
    //             'email' => 'knudsenudvikling@gmail.com',
    //          ]);
    // }
}
