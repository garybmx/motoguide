<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
    public function up() {
        Schema::create('blog_en', function(Blueprint $table) {
            $table->increments('id');
            $table->string('header', 256);
            $table->text('text');
            $table->string('tags', 256);
            $table->date('date');
            $table->boolean('active')->default(0);
      
        });

        Schema::create('blog_ru', function(Blueprint $table) {
            $table->increments('id');
            $table->string('header', 256);
            $table->text('text');
            $table->string('tags', 256);
            $table->date('date');
            $table->boolean('active')->default(0);

       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('blog_ru');
        Schema::drop('blog_en');
    }

}
