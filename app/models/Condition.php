<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Condition
 *
 * @author Manager
 */
class Condition {
    
    protected $language;
    
    function __construct($language) {
        $this->language = $language;
         $this->table = 'condition_' . $this->language;
               
    }
    
    protected function getCondition(){
         return $results = DB::select('select * from '.$this->table);
    }

    
}
