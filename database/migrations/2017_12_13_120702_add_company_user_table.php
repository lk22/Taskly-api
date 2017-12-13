<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_user', function (Blueprint $table) {
            $tabke->integer('comapny_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('company_name');
            $table->string('company_type');
            $table->string('company_address');
            $table->string("comapny_registration_nr");
            $table->string("company_phone_nr");
            $table->string("company_bank_account_nr");
            $table->string("company_bank_registration_nr");
            $table->string("company_iban_nr", 40);
            $table->string("company_swift_address");

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_user', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('company_user');
    }
}
