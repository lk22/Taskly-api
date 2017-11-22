<?php

use Faker\Generator as Faker;

$factory->define(\Taskly\Task::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([
            1,
            function() {
                return factory(\Taskly\User::class)->create()->id;
            }
        ]),

        'task_list_id' => function() {
        	return factory(\Taskly\TaskList::class)->create()->id;
        },

        'name' => $faker->word(3),
        'slug' => strtolower($faker->word(3)),
        'is_checked' => $faker->randomElement([
            false,
            true
        ]),
        'priority' => $faker->randomElement([
            'No priority',
            'Low priority',
            'Medium priority',
            'High priority'
        ])
    ];
});