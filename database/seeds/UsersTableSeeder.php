<?php

use Illuminate\Database\Seeder;

use Taskly\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'firstname'       => 'Leo',
    		'lastname'        => 'Knudsen',
    		'name'            => 'Leo Knudsen',
    		'slug'            => 'leo-knudsen',
    		'email'           => 'knudsenudvikling@gmail.com',
    		'is_admin'        => true,
    		'password'        => bcrypt('test'),
    		'remember_token'  => str_random(10)
    	]);
        factory(User::class, rand(1, 10))->create();
    }
}
