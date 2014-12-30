<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondition extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('condition_en', function($table) {
            $table->integer('tour_id');
            $table->string('duration', 128);
            $table->integer('level_id');
            $table->text('location');

            $table->primary('tour_id');
        });

        Schema::create('condition_ru', function($table) {
            $table->integer('tour_id');
            $table->string('duration', 128);
            $table->integer('level_id');
            $table->text('location');

            $table->primary('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('condition_ru');
        Schema::drop('condition_en');
    }

}
