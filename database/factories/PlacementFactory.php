<?php

use Faker\Generator as Faker;

use Taskly\Placement;

$factory->define(Placement::class, function (Faker $faker) {
    return [
        'task_id' => function() { return factory(\Taskly\Task::class)->create()->id; },
        'name' => $faker->randomElement([
        	'Føtex',
        	'Bilka',
        	'Netto',
        	'Føtex Food',
        	'Salling',
        ]),
        'slug' => $faker->randomElement([
        	'foetex',
        	'bilka',
        	'netto',
        	'foetex-food',
        	'salling'
        ]),
        'streetname' => $faker->streetName,
        'city_code' => $faker->postCode,
        'city' => $faker->city,
    ];
});
