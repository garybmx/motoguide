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
            $table->integer('tour_id');
            $table->string('name', 60);
            $table->string('description', 256);

            $table->primary('tour_id');
        });


        Schema::create('prices_ru', function(Blueprint $table) {
            $table->integer('tour_id');
            $table->string('name', 60);
            $table->string('description', 256);

            $table->primary('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Shema::drop('prices_ru');
        Shema::drop('prices_en');
    }

}
