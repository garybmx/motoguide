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
            $table->integer('level_id');
            $table->string('description', 256);

            $table->primary('level_id');
        });
        
          Schema::create('levels_ru', function(Blueprint $table) {
            $table->integer('level_id');
            $table->string('description', 256);

            $table->primary('level_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Shema::drop('levels_ru');
        
        Shema::drop('levels_en');
    }

}
