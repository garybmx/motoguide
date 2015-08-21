<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('request', function($table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('lastname', 256);
            $table->string('location', 256);
            $table->string('age', 256);
            $table->text('comments');
            $table->string('phone', 256);
            $table->string('email', 256);
            $table->Integer('new');
            $table->timestamp('date');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('request');
    }

}
