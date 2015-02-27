<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Motorcycle
 *
 * @author Manager
 */
class MotorcycleTest extends PHPUnit_Framework_TestCase {


    public static function setUpBeforeClass() {
         $dataclear = new MotorcyclesClear();
        $dataclear->run();
     $dataup = new MotorcyclesSeeder();
      $dataup->run();
    }


    public function testInsertMotorcycleInfo() {

        $motorcycleInfo = array(
            'id' => 'new',
            'active' => '0',
            'model' => 'ktm sx660',
            'power' => '223',
            'weight' => '120',
            'description' => 'good motorcycle',
        );

        $motorcycle = new Motorcycle('en');
        $check = $motorcycle->insertMotorcycleInfo($motorcycleInfo);
        $this->assertTrue($check);
    }


    public function testSetupMotorcycleInfo() {
        $motorcycleF = new Motorcycle('en', 12);
        $false = $motorcycleF->setUpMotorcycleInfo();
        $this->assertFalse($false);
        $motorcycle = new Motorcycle('en', 1);
        $motorArray = $motorcycle->setUpMotorcycleInfo();
        $this->assertInternalType('int', $motorArray['id']);
        $this->assertInternalType('int', $motorArray['active']);
        $this->assertInternalType('string', $motorArray['model']);
        $this->assertInternalType('string', $motorArray['power']);
        $this->assertInternalType('string', $motorArray['description']);
        $this->assertInternalType('int', $motorArray['weight']);
    }


    public function testSetupAllMotorcyclesInfo() {
        $motorcycles = new Motorcycle('en');

        foreach ($motorcycles->setUpAllMotorcylesInfo() as $motorArray) {

            $this->assertInternalType('int', $motorArray['id']);
            $this->assertInternalType('int', $motorArray['active']);
            $this->assertInternalType('string', $motorArray['model']);
            $this->assertInternalType('string', $motorArray['power']);
            $this->assertInternalType('string', $motorArray['description']);
            $this->assertInternalType('int', $motorArray['weight']);
        }
    }


    public function testUpdateMotorcycleInfo() {

        $motorcycleInfo = array(
            'id' => '1',
            'active' => '1',
            'model' => 'x660',
            'power' => '123',
            'weight' => '320',
            'description' => 'good motorcycle',
        );

        $motorcycles = new Motorcycle('ru', 1);
        $motorcyclesF = new Motorcycle('ru', 11);

        $check1 = $motorcycles->updateMotorcycleInfo($motorcycleInfo);
        $check2 = $motorcyclesF->updateMotorcycleInfo($motorcycleInfo);

        $this->assertTrue($check1);
        $this->assertFalse($check2);
    }

    
    public function testDeleteMotorcycle() {


        $motorcycle = new Motorcycle('en', 1);
        $check = $motorcycle->deleteMotorcycleInfo();
        $this->assertTrue($check);
    }

    public static function tearDownAfterClass() {
        $dataclear = new MotorcyclesClear();
        $dataclear->run();
    }

}
