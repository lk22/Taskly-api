<?php

use Faker\Generator as Faker;

$factory->define(Taskly\TaskList::class, function (Faker $faker) {
    return [
        'user_id' => function() {
        	return factory(Taskly\User::class)->create()->id;
        },
        'name' => 'Tasklist-' . rand(1, 100),
        'slug' => 'tasklist-' .rand(1, 100)
    ];
});
