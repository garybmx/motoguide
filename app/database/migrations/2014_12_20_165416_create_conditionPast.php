<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionPast extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('conditionPast_en', function(Blueprint $table) {
            $table->integer('tour_id');
            $table->text('review');

            $table->primary('tour_id');
        });

        Schema::create('conditionPast_ru', function(Blueprint $table) {
            $table->integer('tour_id');
            $table->text('review');

            $table->primary('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Shema::drop('conditionPast_en');
        Shema::drop('conditionPast_ru');
    }

}
