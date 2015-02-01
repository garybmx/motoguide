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


    public static function setUpBeforeClass() {
        $dataup = new DatabaseSeeder();
        $dataup->run();
    }


    public function testFutureGetTourList() {
        $futureTourList = new FutureTour('en');
        foreach ($futureTourList->setUpAllToursInfo() as $tour) {

            $this->assertInternalType('string', $tour['name']);
            $this->assertInternalType('int', $tour['tourType_id']);
            $this->assertInternalType('int', $tour['tour_id']);
            $this->assertInternalType('string', $tour['startTime']);
            $this->assertInternalType('string', $tour['endTime']);
            $this->assertInternalType('string', $tour['description']);
        }
    }


    public function testGetFutureTourInfo() {
        $tourInfo = new FutureTour('en', 1);
        $info = $tourInfo->setUpTourInfo();
        $this->assertInternalType('int', $info['tour_id']);
        $this->assertInternalType('int', $info['tourType_id']);
        $this->assertInternalType('string', $info['startTime']);
        $this->assertInternalType('string', $info['endTime']);
        $this->assertInternalType('string', $info['description']);
        $this->assertInternalType('string', $info['duration']);
        $this->assertInternalType('string', $info['level']);
        $this->assertInternalType('string', $info['location']);
        $this->assertInternalType('string', $info['residence']);
        $this->assertInternalType('string', $info['feed']);
        $this->assertInternalType('array', $info['price']);
    }


    public function testAddTour() {
        $futureTourInfo = array(
            'tour_id' => 'new',
            'tourType_id' => '1',
            'name' => 'addTour',
            'startTime' => '2015-1-1',
            'endTime' => '2015-1-10',
            'description' => 'add Tour test',
            'duration' => '10',
            'level' => '1',
            'location' => 'bulgaria',
            'residence' => 'hostel',
            'feed' => '2 times a day',
            'price' => array(
                array(
                    'price_id' => 'new',
                    'tour_id' => 'new',
                    'name' => 'moto',
                    'price' => '10'
                ),
                array(
                    'price_id' => 'new',
                    'tour_id' => 'new',
                    'name' => 'feed',
                    'price' => '12'
                )
            )
        );

        $futureTour = new FutureTour('en');
        $check = $futureTour->addTour($futureTourInfo);

        $this->assertTrue($check);
    }


    public function testUpdateTour() {
        $futureTourInfo = array(
            'tour_id' => '1',
            'tourType_id' => '1',
            'name' => 'updateTour',
            'startTime' => '2015-1-1',
            'endTime' => '2015-1-10',
            'description' => 'add Tour test',
            'duration' => '10',
            'level' => '1',
            'location' => 'bulgaria',
            'residence' => 'hostel',
            'feed' => '2 times a day',
            'price' => array(
                array(
                    'price_id' => '1',
                    'tour_id' => '1',
                    'name' => 'moto',
                    'price' => '10'
                ),
                array(
                    'price_id' => '7',
                    'tour_id' => '1',
                    'name' => 'feed',
                    'price' => '12'
                )
            )
        );

        $futureTour = new FutureTour('en', 1);
        $check = $futureTour->updateTour($futureTourInfo);
        $this->assertTrue($check);
    }


    public function testDeleteTour() {


        $futureTour = new FutureTour('en', 2);
        $check = $futureTour->deleteTour();
        $this->assertTrue($check);
    }


    public static function tearDownAfterClass() {
        $dataclear = new DataClear();
        $dataclear->run();
    }

}
