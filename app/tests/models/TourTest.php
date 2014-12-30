<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TourTest
 *
 * @author Manager
 */
class TourTest extends TestCase {

    private $stub;

    public function setUp() {
        $this->stub = $this->getMockForAbstractClass('Tour', array('ru'));
    }

    public function testgetFullTourInfo() {

        $this->stub->expects($this->any())
                ->method('getFullTourInfo')
                ->with('1');
        $this->assertInternalType("array", $this->stub->getFullTourInfo('1'));
    }

    public function testgetAllTour() {
        $this->stub->expects($this->any())
                ->method('getAllTour')
                ->with('1');
        $this->assertInternalType("array", $this->stub->getFullTourInfo('1'));
    }

}
