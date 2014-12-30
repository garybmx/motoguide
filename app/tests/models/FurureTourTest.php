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

    function setUp() {
        $dataup = new DatabaseSeeder();
        $dataup->run();
    }
    
    public function testSetUpTourInfo(){
        $tourInfo = new FutureTour('en', 1);
        $tourInfo->setUpTourInfo();
    }

    

    public function testGetFutureTour() {
   
        //    print_r($futureTour->getFutureTourInfo());
    }

    public function testGetTourList() {
        $futureTourList = new FutureTour('en');
        foreach ($futureTourList->getAllTour('1') as $tour) {
            $this->assertInternalType('string', $tour->name);
            $this->assertInternalType('int', $tour->tourType_id);
            $this->assertInternalType('string', $tour->startTime);
            $this->assertInternalType('string', $tour->endTime);
            $this->assertInternalType('string', $tour->description);
        }
    }

    public function testGetFutureTourInfo(){
        $tourInfo = new FutureTour('en', 1);
        foreach ($tourInfo->setUpAllToursInfo() as $info) {
            //$this->assertInternalType('string', $info->duration);
            }
    }
    
    public function tearDown() {
        $dataclear = new DataClear();
        $dataclear->run();
    }

}
