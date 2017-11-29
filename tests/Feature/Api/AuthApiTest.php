<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

use Taskly\User;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: hit_api_route
     * @todo hit home api route
     * @test
     */
    //public function hit_api_route()
    //{
    //    $this->withoutExceptionHandling();
    //    $this->get('api/v1')
    //         ->assertStatus(200)
    //         ->assertExactJson([
    //             'data' => [
    //                 'response' => 'success'
    //             ]
    //         ]);
    //}

    /**
     * @description: give_bad_request_on_authentication_error
     * @todo test the client gets 322 code on authentication
     * @test
     */
    public function give_bad_request_on_authentication_error()
    {
        $this->withoutExceptionHandling();
        $this->post(route('login.api'), [
            'username' => 'knudsenudvikling@gmail.com',
            'password' => bcrypt('test')
        ])->assertStatus(322);
    }

    /**
     * @description: hit_login_route
     * @todo test api login route
     * @test
     */
    // public function hit_login_route() {
    // 	$this->withoutExceptionHandling();

    // 	$this->post(route('login.api'), [
    // 		'username' => 'knudsenudvikling@gmail.com',
    // 		'password' => bcrypt('test')
    // 	])->assertStatus(200);

    // 	$this->assertAuthenticated();
    // }

    // /**
    //  * @description: hit_logout_route
    //  * @todo test logout route
    //  * @test
    //  */
    // public function hit_logout_route() {
    // 	$this->withoutExceptionHandling();



    // }
}
