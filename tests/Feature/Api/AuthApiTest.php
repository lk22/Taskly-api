<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthApiTest extends TestCase
{

	use RefreshDatabase;

    /**
     * @description: hit_api_route
     * @todo hit home api route
     * @test
     */
    public function hit_api_route() {
    	$this->withoutExceptionHandling();
    	$this->get(route('home.api'))
    		 ->assertStatus(200)
    		 ->assertExactJson([
    		 	'response' => 'success'
    		 ]);
    }

    // /**
    //  * @description: hit_login_route
    //  * @todo test api login route
    //  * @test
    //  */
    // public function hit_login_route() {
    // 	$this->withoutExceptionHandling();
    // 	$this->post(route('login.api'), [
    // 		'email' => 'knudsenudvikling@gmail.com',
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
