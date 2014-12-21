<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FutureTour
 *
 * @author Manager
 */
class FutureTour extends Tour {
    private $condition;
   
    function __construct($language) {
        parent::__construct($language);
        $this->condition = new ConditionFuture($this->language);
    }
    
    function getResult(){
        return $results = DB::select('select * from '. $this->table);
    } 
       
}
