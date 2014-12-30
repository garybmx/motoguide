<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TourFactoryTest
 *
 * @author Manager
 */
class TourFactoryTest extends TestCase {

    public function testTourFactoryReturnRightObject() {
        $factoryObject = new TourFactory;
        $this->assertInstanceOf('FutureTour', $factoryObject->getTour('FutureTour', 'en', '1'));
        $this->assertInstanceOf('PastTour', $factoryObject->getTour('PastTour', 'en', '1'));
        $this->assertInstanceOf('Tour', $factoryObject->getTour('PastTour', 'en', '1'));
        $this->assertInstanceOf('Tour', $factoryObject->getAllTours('PastTour', 'en'));
    }

}
