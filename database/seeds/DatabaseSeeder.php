<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

	protected $defaultSeeders = [
		UsersTableSeeder::class,
		TasklistsTableSeeder::class,
		TasksTableSeeder::class,
		PlacementsTableSeeder::class
	];

	protected $defaultTables = [
		'users',
		'tasks',
		'task_lists',
		'placements',
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	if(App::environment() === 'production')
    		exit('Cannot fire seeders in production environment');

    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        echo "Will truncate " . count($this->defaultTables) . " tables\n";
		echo "--------------\n";
    	foreach ($this->defaultTables as $table) {
    		DB::table($table)->truncate();
    	}

    	foreach ($this->defaultSeeders as $seeder) {
    		$this->call($seeder);
    	}

    	DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
