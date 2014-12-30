<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConditionTest
 *
 * @author Manager
 */
class ConditionTest extends TestCase {

    public function testGetCondition() {
        $condition = new Condition('en' , '1');
        $this->assertInternalType('array', $condition->getCondition());
    }

}
