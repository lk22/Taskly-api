<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('company_name');
            $table->string('company_type');
            $table->string('company_address');
            $table->string('company_registration_nr')->nullable();
            $table->string('company_phone_nr');
            $table->string('company_bank_account_nr');
            $table->string('company_bank_registration_nr')->nullable();
            $table->string('company_iban_nr');
            $table->string('company_swift_address');
            $table->timestamps();

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
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('companies');
    }
}
