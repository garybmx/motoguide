<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PastTourTest
 *
 * @author Manager
 */
class PastTourTest extends PHPUnit_Framework_TestCase {


    public static function setUpBeforeClass() {
      $dataup = new DatabaseSeeder();
      $dataup->run();
    }


    public function testGetPastTourList() {
        $futureTourList = new PastTour('en');
        foreach ($futureTourList->setUpAllToursInfo('2') as $tour) {

            $this->assertInternalType('string', $tour['name']);
            $this->assertInternalType('int', $tour['tourType_id']);
            $this->assertInternalType('int', $tour['tour_id']);
            $this->assertInternalType('string', $tour['startTime']);
            $this->assertInternalType('string', $tour['endTime']);
            $this->assertInternalType('string', $tour['description']);
        }
    }


    public function testGetFutureTourInfo() {
        $tourInfo = new PastTour('en', 3);
        $info = $tourInfo->setUpTourInfo();
        $this->assertInternalType('int', $info['tour_id']);
        $this->assertInternalType('int', $info['tourType_id']);
        $this->assertInternalType('string', $info['startTime']);
        $this->assertInternalType('string', $info['endTime']);
        $this->assertInternalType('string', $info['description']);
        $this->assertInternalType('string', $info['duration']);
        $this->assertInternalType('string', $info['level_id']);
        $this->assertInternalType('string', $info['location']);
        $this->assertInternalType('string', $info['review']);
    }


    public function testAddTour() {
        $pastTourInfo = array(
            'tour_id' => 'new',
            'tourType_id' => '2',
            'active' => '0',
            'name' => 'add past Tour',
            'startTime' => '2014-06-06',
            'endTime' => '2014-06-08',
            'description' => 'past tour in july',
            'duration' => '2 days',
            'level_id' => '2',
            'location' => 'bulgaria',
            'review' => 'it was cool tour'
        );
        $pastTour = new PastTour('en');
        $check = $pastTour->addTour($pastTourInfo);
        $this->assertTrue($check);
    }


    public function testUpdateTour() {
         $pastTourInfo = array(
            'tour_id' => '3',
             'active' => '0',
            'tourType_id' => '2',
            'name' => 'add past Tour 6',
            'startTime' => '2014-06-06',
            'endTime' => '2014-06-08',
            'description' => 'past tour in july',
            'duration' => '2 days',
            'level_id' => '2',
            'location' => 'bulgaria',
            'review' => 'it was cool tour'
        );

        $pastTour = new PastTour('en', 3);
        $check = $pastTour->updateTour($pastTourInfo);
        $this->assertTrue($check);
    }
    
 public function testDeleteTour() {


        $futureTour = new PastTour('en', 3);
        $check = $futureTour->deleteTour();
        $this->assertTrue($check);
    }



    public static function tearDownAfterClass() {
        $dataclear = new DataClear();
        $dataclear->run();
    }

}
