<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Taskly\Placement;
use Taskly\Task;
use Taskly\User;

class PlacementsApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @description: hit_placements_api_endpoint
     * @todo test client can hit the placements api endpoint
     * @test
     */
    //public function hit_placements_api_endpoint() {
    //	$this->withoutExceptionHandling();

    //$this->get(route('placements.api'))
    //			 ->assertStatus(200);
    //	}

    /**
     * @description: hit_single_placement_api
     * @todo test client can get a single placement
     * @test
     */
    public function hit_single_placement_api()
    {
        $this->withoutExceptionHandling();

        $placement = $this->make(Placement::class);

        $this->get(route('placement.single.api', [$placement->id]))
             ->assertStatus(200);
    }

    /**
     * @todo assert json structure for a single placement
     * @test
     */
    public function assert_placements_json_structure_from_api()
    {
        $this->withoutExceptionHandling();

        $task = $this->make(Task::class, [
            'name' => 'task1',
        ]);

        $placement = $this->make(Placement::class, [
            'task_id' => $task->id,
            'name' => 'Bilka Køge',
            'slug' => 'bikla-koege',
            'streetname' => 'Kystvejen 2',
            'city_code' => '4600',
            'city' => 'Køge'
        ]);

        $this->json('GET', route('placement.single.api', [$placement->slug]))
              ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'streetname',
                    'city_code',
                    'city',
                    'task' => [
                        'data' => [
                            'id',
                            'name',
                            'slug',
                            'is_checked'
                        ]
                    ]
                ]
            ]);
    }

    /**
     * @todo assert fragments from the json response
     * @test
     */
    public function assert_placements_json_fragments_from_api_call()
    {
        $this->withoutExceptionHandling();

        $task = $this->make(Task::class, [
            'name' => 'task1',
            'slug' => 'task-1',
            'is_checked' => true
        ]);

        $placement = $this->make(Placement::class, [
            'task_id' => $task->id,
            'name' => 'Bilka Koege',
            'slug' => 'bikla-koege',
            'streetname' => 'Kystvejen 2',
            'city_code' => '4600',
            'city' => 'Koege'
        ]);

        // dd($placement->with('task')->first()->toArray());

        $this->json('GET', route('placement.single.api', [$placement->slug]))
              ->assertJsonFragment([
                    'id' => $placement->id,
                    'name' => $placement->name,
                    'streetname' => $placement->streetname,
                    'city_code' => $placement->city_code,
                    'city' => $placement->city
              ])->assertJsonFragment([
                  'name' => 'task1',
                  'slug' => 'task-1',
                  'is_checked' => true
              ]);
    }

    /**
     * @todo
     * @test
     */
    // public function assert_exact_json_response_from_placements_api() {
    // 	$this->withoutExceptionHandling();

    // 	$user = $this->make(User::class, [
    // 		'firstname' => 'Leo',
    // 		'lastname' => 'Knudsen',
    // 		'slug' => 'leo-knudsen',
    // 		'email' => 'knudsenudvikling@gmail.com',
    // 		'is_admin' => true
    // 	]);

    // 	$task = $this->make(Task::class, [
    // 		'name' => 'task1',
    // 		'slug' => 'task-1',
    // 		'is_checked' => true,
    // 		'user_id' => $user->id
    // 	]);

    // 	$placement = $this->make(Placement::class, [
    // 		'task_id' => $task->id,
    // 		'name' => 'Bilka Koege',
    // 		'slug' => 'bikla-koege',
    // 		'streetname' => 'Kystvejen 2',
    // 		'city_code' => '4600',
    // 		'city' => 'Koege'
    // 	]);
    // 	// dd($placement->with('task')->first()->toArray());

    // 	$this->json('GET', route('placement.single.api', [$placement->slug]))
    // 	      ->assertExactJson([
    // 			'data' => [
    // 				'city' => $placement->city,
    // 				'city_code' => $placement->city_code,
    // 				'id' => $placement->id,
    // 				'name' => $placement->name,
    // 				'streetname' => $placement->streetname,
    // 				'task' => [
    // 					'data' => [
    // 						'id' => $task->id,
    // 						'is_checked' => $task->is_checked,
    // 						'name' => $task->name,
    // 						'slug' => $task->slug,
    // 						'user' => [
    // 							'data' => [
    // 								'email' => $user->email,
    // 								'firstnmae' => $user->firstname,
    // 								'fullname' => $user->firstname . ' ' . $user->lastname,
    // 								'id' => $user->id,
    // 								'is_admin' => $user->is_admin,
    // 								'lastname' => $user->lastname,
    // 								'slug' => $user->slug,
    // 								'tasklists' => ['data' => []]
    // 							]
    // 						]
    // 					]
    // 				]
    // 			]
    // 	      ]);
    // }
}
