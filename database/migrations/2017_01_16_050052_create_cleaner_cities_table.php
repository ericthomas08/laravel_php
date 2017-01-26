<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleanerCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleaner_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cleaner_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('city')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cleaner_id')->references('id')->on('cleaner')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cleaner_cities', function ($t) {
            $t->dropForeign('cleaner_cities_city_id_foreign');
            $t->dropForeign('cleaner_cities_cleaner_id_foreign');
        });

        Schema::dropIfExists('cleaner_cities');
    }
}
