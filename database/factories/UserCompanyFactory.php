<?php

use Faker\Generator as Faker;

$factory->define(Taskly\Company::class, function (Faker $faker) {
    return [
        'user_id' => function() {
        	return factory(Taskly\User::class)->create()->id;
        },
        'company_name' => $faker->company,
        'company_type' => $faker->randomElement([
        	'Enkeltmand',
        	'IVS',
        	'ApS',
        	'A/S',
        ]),
        'company_address' => $faker->address,
        'company_registration_nr' => '',
        'company_phone_nr' => $faker->phoneNumber,
        // 'company_bank_account_nr' => $faker->creditCardDetails([
        // 	$faker->creditCardType,
        // 	$faker->creditCardNumber,
        // 	function() {
        // 		return factory(Taskly\User::class)->create()->name;
        // 	},
        // 	$faker->creditCardExpirationDateString
        // ]),
        'company_bank_account_nr' => 'xxxx xxxx xxxx xxxx',
        'company_bank_registration_nr' => 'xxxx',
        'company_iban_nr' => $faker->iban(null),
        'company_swift_address' => $faker->swiftBicNumber
    ];
});