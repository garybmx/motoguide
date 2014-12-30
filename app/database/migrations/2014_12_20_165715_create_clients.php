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
            $table->integer('id');
            $table->string('name', 60);
            $table->text('review');

            $table->primary('id');
        });

        Schema::create('clients_ru', function(Blueprint $table) {
            $table->integer('id');
            $table->string('name', 60);
            $table->text('review');

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('clients_ru');
        Schema::drop('clients_en');
    }

}
