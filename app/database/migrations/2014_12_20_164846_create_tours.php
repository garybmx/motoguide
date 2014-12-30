<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTours extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tours_en', function($table) {
            $table->increments('tour_id');
            $table->integer('tourType_id');
            $table->string('name', 128);
            $table->date('startTime');
            $table->date('endTime');
            $table->text('description');
        });

        Schema::create('tours_ru', function($table) {
            $table->increments('tour_id');
            $table->integer('tourType_id');
            $table->string('name', 128);
            $table->date('startTime');
            $table->date('endTime');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tours_ru');
        Schema::drop('tours_en');
    }

}
