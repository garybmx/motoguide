<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InformationCreate extends Migration {


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('information_ru', function($table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('value', 512);
        });

        DB::table('information_ru')->insert(array(
            array('name' => 'banner_head_1', 'value' => ''),
            array('name' => 'banner_text_1', 'value' => ''),
            array('name' => 'banner_head_2', 'value' => ''),
            array('name' => 'banner_text_2', 'value' => ''),
            array('name' => 'banner_head_3', 'value' => ''),
            array('name' => 'banner_text_3', 'value' => ''),
            array('name' => 'info_head_1', 'value' => ''),
            array('name' => 'info_text_1', 'value' => ''),
            array('name' => 'info_head_2', 'value' => ''),
            array('name' => 'info_text_2', 'value' => ''),
            array('name' => 'info_head_3', 'value' => ''),
            array('name' => 'info_text_3', 'value' => ''),            
            array('name' => 'about_1', 'value' => ''),
            array('name' => 'video_1', 'value' => ''),
        ));


        Schema::create('information_en', function($table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('value', 512);
        });
        
        DB::table('information_en')->insert(array(
            array('name' => 'banner_head_1', 'value' => ''),
            array('name' => 'banner_text_1', 'value' => ''),
            array('name' => 'banner_head_2', 'value' => ''),
            array('name' => 'banner_text_2', 'value' => ''),
            array('name' => 'banner_head_3', 'value' => ''),
            array('name' => 'banner_text_3', 'value' => ''),
            array('name' => 'info_head_1', 'value' => ''),
            array('name' => 'info_text_1', 'value' => ''),
            array('name' => 'info_head_2', 'value' => ''),
            array('name' => 'info_text_2', 'value' => ''),
            array('name' => 'info_head_3', 'value' => ''),
            array('name' => 'info_text_3', 'value' => ''),            
            array('name' => 'about_1', 'value' => ''),
            array('name' => 'video_1', 'value' => ''),
        ));
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('information_ru');
        Schema::drop('information_en');
    }

}
