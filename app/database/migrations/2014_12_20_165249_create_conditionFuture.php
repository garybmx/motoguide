<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConditionFuture extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('conditionFuture_en', function(Blueprint $table) {
            $table->integer('tour_id');
            $table->string('residence', 128);
            $table->string('feed', 256);

            $table->primary('tour_id');
        });

        Schema::create('conditionFuture_ru', function(Blueprint $table) {
            $table->integer('tour_id');
            $table->string('residence', 128);
            $table->string('feed', 256);

            $table->primary('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('conditionFuture_ru');
        Schema::drop('conditionFuture_en');
    }

}
