<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Taskly\User::class, function (Faker $faker) {
    static $password;

    return [
    	'firstname'        => $faker->firstname,
    	'lastname'         => $faker->lastname,
    	'name'             => $faker->firstname . ' ' . $faker->lastname,
    	'slug'             => strtolower($faker->firstname) . '-' . strtolower($faker->lastname),
    	'email'            => $faker->unique()->safeEmail,
    	'password'         => $password ?: $password = bcrypt('secret'),
    	'is_admin'         => $faker->randomElement([true, false])
    ];
});