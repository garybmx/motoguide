<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClients extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clients_en', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(0);
            $table->string('name', 60);
            $table->text('review');

        
        });

        Schema::create('clients_ru', function(Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(0);
            $table->string('name', 60);
            $table->text('review');

         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('clients_en');
        Schema::drop('clients_ru');
      
    }

}
