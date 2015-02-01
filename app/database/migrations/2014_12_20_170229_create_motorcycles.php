<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorcycles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('motorcycles_en', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(0);
            $table->string('model', 60);
            $table->string('power', 60);
            $table->integer('weight')->default(0);
            $table->text('description');

          
        });
        
          Schema::create('motorcycles_ru', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(0);
            $table->string('model', 60);
            $table->string('power', 60);
            $table->integer('weight')->default(0);
            $table->text('description');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('motorcycles_ru');        
        Schema::drop('motorcycles_en');
    }

}
