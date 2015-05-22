<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreteContacts extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contacts_ru', function($table) {
            $table->integer('contact_id');
            $table->string('address', 256);
            $table->string('phone', 128);
            $table->string('mail', 128);

            $table->primary('contact_id');
        });

        Schema::create('contacts_en', function($table) {
            $table->integer('contact_id');
            $table->string('address', 256);
            $table->string('phone', 128);
            $table->string('mail', 128);

            $table->primary('contact_id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('contacts_ru');
        Schema::drop('contacts_en');
    }

}
