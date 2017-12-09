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
        // build specifc tasklist
        Tasklist::create([
            'name' => 'Netto Svanemøllen',
            'slug' => 'netto-svanemøllen',
            'user_id' => 1,
        ]);

        factory(TaskList::class, rand(1, 10))->create([
            'user_id' => rand(1, 10)
        ]);
    }
}
