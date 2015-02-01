<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataClear
 *
 * @author Manager
 */
class DataClear extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('tours_en')->truncate();
         DB::table('condition_en')->truncate();
          DB::table('prices_en')->truncate();
             DB::table('levels_en')->truncate();
        DB::table('tours_ru')->truncate();
          DB::table('conditionfuture_en')->truncate();
            DB::table('conditionpast_en')->truncate();
            DB::table('clients_en')->truncate();
      
    }

    //Eloquent::unguard();
    //  $this->call('UserTableSeeder');
}