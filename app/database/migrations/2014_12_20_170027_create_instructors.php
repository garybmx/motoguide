<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructors extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('instructors_en', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(0);
            $table->string('name', 60);
            $table->string('lastname', 60);
            $table->integer('age')->default(0);
            $table->text('expirience');

      
        });

        Schema::create('instructors_ru', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(0);
            $table->string('name', 60);
            $table->string('lastname', 60);
            $table->integer('age')->default(0);
            $table->text('expirience');

       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('instructors_ru');
        Schema::drop('instructors_en');
    }

}
