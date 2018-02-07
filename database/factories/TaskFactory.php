<?php

use Faker\Generator as Faker;

$factory->define(\Taskly\Task::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([
            1,
            function () {
                return factory(\Taskly\User::class)->create()->id;
            }
        ]),
        'location' => $faker->randomElement([
            'Bilka Hundige', 
            'Bilka Ishøj',
            'Foetex Ishøj',
            'Netto Svanemøllen',
            'Netto Amagerbro',
        ]),
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
        ]),
        'work_hours' => $faker->randomElement([
            '1 time',
            '2 timer',
            '3 timer',
            '4 timer',
            '5 timer',
            '6 timer',
            '7 timer',
            '8 timer',
            '9 timer',
            '10 timer'
        ]),
        'week_day' => $faker->randomElement([
            'Monday',
            'Tuesday',
            'Wednesday',
            'Tuesday',
            'Friday',
            'Saturday',
            'Sunday'
        ]),
        'week' => rand(1, 52),
        'start_at' => \Carbon\Carbon::now()->addHours(1),
        'end_at' => \Carbon\Carbon::now()->addHours(3),
        'supplier' => $faker->randomElement([
            'Toms',
            'Løgismose',
            'Øgo',
            'Galle & Jessen'
        ])
    ];
});
