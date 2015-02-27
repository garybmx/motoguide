<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConditionFutureTest
 *
 * @author Manager
 */
class ConditionFutureTest extends PHPUnit_Framework_TestCase {
    
    public function testgetAllCondition(){
        $allcondition = new ConditionFuture('en', 'id');
        $this->assertInstanceOf('Condition', $allcondition);
        $this->assertInternalType('array', $allcondition->getAllCondition());
        
    }
    
}
