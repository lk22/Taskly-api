<?php

use Illuminate\Database\Seeder;

use Taskly\Placement;

class PlacementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Placement::class, rand(1, 10))->create([
        	'task_id' => rand(1, 10),
        	'city_code' => '4600'
        ]);
    }
}
