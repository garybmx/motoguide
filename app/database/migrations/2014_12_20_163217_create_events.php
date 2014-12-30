<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('events_ru', function($table) {
            $table->increments('event_id');
            $table->string('name', 128);
        });

        Schema::create('events_en', function($table) {
            $table->increments('event_id');
            $table->string('name', 128);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('events_en');
        Schema::drop('events_ru');
    }

}
