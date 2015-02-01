<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MotorcyclesSeeder
 *
 * @author Manager
 */
class MotorcyclesSeeder extends Seeder {
    public function run() {
      
        
         DB::table('motorcycles_en')->insert(array(
            array('id' => '1','active'=> '0', 'model' => 'ds', 'power' => '232', 'weight' => '22', 'description'=> 'desc')
         
        ));
         
              DB::table('motorcycles_ru')->insert(array(
            array('id' => '1','active'=> '0',  'model' => 'ds', 'power' => '232', 'weight' => '22', 'description'=> 'desc')
         
        ));
    
    }
    
    
}
