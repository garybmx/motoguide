<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FurureTourTest
 *
 * @author Manager
 */
class FurureTourTest extends TestCase {
    
    
    public function testTouransw() {
        $tour = new FutureTour('en');
        $this->assertTrue(is_array($tour->getResult()));
           
    }
}
