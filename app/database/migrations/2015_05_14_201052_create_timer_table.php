<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimerTable extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('timer', function($table) {
            $table->integer('id');
            $table->integer('tour_id');
            $table->date('date', 128);
            $table->time('time', 128);
            $table->boolean('active')->default(0);

            $table->primary('id');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('timer');
    }

}
