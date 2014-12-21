<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConditionFuture
 *
 * @author Manager
 */
class ConditionFuture extends Condition {
    
    private $condition;
            
            
    function __construct($language) {
        parent::__construct($language);
        
    }
    
    public function getFutureCondition(){
        $this->condition = getCondition();
        
    }
    
    
    
}
