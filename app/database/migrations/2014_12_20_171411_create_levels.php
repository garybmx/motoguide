<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevels extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('levels_en', function(Blueprint $table) {
            $table->increments('level_id');
             $table->string('name', 256);
            $table->text('description');

           
        });
        
          Schema::create('levels_ru', function(Blueprint $table) {
            $table->increments('level_id');
             $table->string('name', 256);
            $table->text('description');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('levels_ru');
        
        Schema::drop('levels_en');
    }

}
