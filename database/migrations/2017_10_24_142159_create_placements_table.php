<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('streetname');
            $table->string('city_code', 4)->index()->default('');
            $table->string('city', 256);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('placements', function(Blueprint $table) {
            $table->dropColumn('task_id');
        });
        Schema::dropIfExists('placements');
    }
}
