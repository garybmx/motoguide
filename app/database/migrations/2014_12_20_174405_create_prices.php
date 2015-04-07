<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrices extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prices_en', function(Blueprint $table) {
            $table->increments('price_id');
            $table->integer('tour_id');
            $table->string('name', 60);
            $table->string('price', 256);
            $table->text('description');
        });


        Schema::create('prices_ru', function(Blueprint $table) {
            $table->increments('price_id');
            $table->integer('tour_id');
            $table->string('name', 60);
            $table->string('price', 256);
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prices_ru');
        Schema::drop('prices_en');
    }

}
