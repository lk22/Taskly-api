<?php

use Illuminate\Database\Seeder;

use Taskly\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class, rand(1, 10))->create();
    }
}
