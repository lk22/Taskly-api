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

    	Company::create([
    		'user_id' => 1,
    		'company_name' => 'Knudsen Design & Udvikling',
    		'company_type' => 'Enkeltmand',
    		'company_address' => 'Guldbergsgade 113 4TV',
    		'company_registration_nr' => str_random(8),
    		'company_phone_nr' => '+45 27 45 94',
    		'company_bank_account_nr' => 'xxxx xxxx xxxx xxxx',
    		'company_iban_nr' => "null",
    		'company_swift_address' => "null"
    	]);

        factory(Company::class, rand(1, 10))->create();
    }
}
