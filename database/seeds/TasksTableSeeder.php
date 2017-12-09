<?php

use Illuminate\Database\Seeder;

use Taskly\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // seed random tasks to specific tasklist
        factory(Task::class, rand(1, 10))->create([
            'user_id' => 1,
            'task_list_id' => 1
        ]);

        factory(Task::class, rand(1, 10))->create([
            'task_list_id' => rand(1, 10),
            'user_id' => rand(1, 10)
        ]);
    }
}
