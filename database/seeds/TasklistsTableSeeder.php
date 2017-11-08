<?php

use Illuminate\Database\Seeder;

use Taskly\TaskList;

class TasklistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TaskList::class, rand(1, 10))->create([
        	'user_id' => rand(1, 10)
        ]);
    }
}
