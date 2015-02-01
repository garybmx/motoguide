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
class MotorcycleTest extends TestCase {


    public static function setUpBeforeClass() {
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

        $motorcycle = new Motocycle('en');
        $check = $motorcycle->insertMotorcycleInfo($motorcycleInfo);
        $this->assertTrue($check);
    }


    public function testSetupMotorcycleInfo() {
        $mototorcycleF = new Motocycle('en', 12);
        $false = $mototorcycleF->setUpMotorcycleInfo();
        $this->assertFalse($false);
        $mototorcycle = new Motocycle('en', 1);
        $motorArray = $mototorcycle->setUpMotorcycleInfo();
        $this->assertInternalType('int', $motorArray['id']);
        $this->assertInternalType('int', $motorArray['active']);
        $this->assertInternalType('string', $motorArray['model']);
        $this->assertInternalType('string', $motorArray['power']);
        $this->assertInternalType('string', $motorArray['description']);
        $this->assertInternalType('int', $motorArray['weight']);
    }


    public function testSetupAllMotorcyclesInfo() {
        $motorcycles = new Motocycle('en');

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

        $motorcycles = new Motocycle('ru', 1);
        $motorcyclesF = new Motocycle('ru', 11);

        $check1 = $motorcycles->updateMotorcycleInfo($motorcycleInfo);
        $check2 = $motorcyclesF->updateMotorcycleInfo($motorcycleInfo);

        $this->assertTrue($check1);
        $this->assertFalse($check2);
    }


    public static function tearDownAfterClass() {
        $dataclear = new MotorcyclesClear();
        $dataclear->run();
    }

}
