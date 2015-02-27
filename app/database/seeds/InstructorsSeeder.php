<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstructorsSeeder
 *
 * @author Manager
 */
class InstructorsSeeder extends Seeder {
    public function run() {
      
        
         DB::table('instructors_en')->insert(array(
            array('id' => '1','active'=> '0', 'name' => 'ds', 'lastname' => '232', 'age' => '22', 'expirience'=> 'desc')
         
        ));
         
              DB::table('instructors_ru')->insert(array(
            array('id' => '1','active'=> '0', 'name' => 'ds', 'lastname' => '232', 'age' => '22', 'expirience'=> 'desc')
         
        ));
    
    }
}
