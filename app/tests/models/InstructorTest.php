<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstructorTest
 *
 * @author Manager
 */
class InstructorTest extends PHPUnit_Framework_TestCase {


    public static function setUpBeforeClass() {
        $dataup = new InstructorsSeeder();
        $dataup->run();
    }


    public function testInsertInstructorInfo() {

        $instructorInfo = array(
            'id' => 'new',
            'active' => '0',
            'name' => 'ktm sx660',
            'lastname' => '223',
            'age' => '120',
            'expirience' => 'good instructor'
        );

        $instructor = new Instructor('en');
        $check = $instructor->insertInstructorInfo($instructorInfo);
        $this->assertTrue($check);
    }


    public function testSetupInstructorInfo() {
        $instructorF = new Instructor('en', 12);
        $false = $instructorF->setUpInstructorInfo();
        $this->assertFalse($false);
        $instructor = new Instructor('en', 1);
        $instructorArray = $instructor->setUpInstructorInfo();
        $this->assertInternalType('int', $instructorArray['id']);
        $this->assertInternalType('int', $instructorArray['active']);
        $this->assertInternalType('string', $instructorArray['name']);
        $this->assertInternalType('string', $instructorArray['lastname']);
        $this->assertInternalType('string', $instructorArray['expirience']);
        $this->assertInternalType('int', $instructorArray['age']);
    }


    public function testSetupAllInstructorsInfo() {
        $instructors = new Instructor('en');

        foreach ($instructors->setUpAllInstructorsInfo() as $instructorArray) {

            $this->assertInternalType('int', $instructorArray['id']);
            $this->assertInternalType('int', $instructorArray['active']);
            $this->assertInternalType('string', $instructorArray['name']);
            $this->assertInternalType('string', $instructorArray['lastname']);
            $this->assertInternalType('string', $instructorArray['expirience']);
            $this->assertInternalType('int', $instructorArray['age']);
        }
    }


    public function testUpdateInstructorInfo() {

        $instructorInfo = array(
             'id' => 'new',
            'active' => '0',
            'name' => 'ktm sx660',
            'lastname' => '223',
            'age' => '120',
            'expirience' => 'good instructor'
        );

        $instructors = new Instructor('ru', 1);
        $instructorsF = new Instructor('ru', 11);

        $check1 = $instructors->updateInstructorInfo($instructorInfo);
        $check2 = $instructorsF->updateInstructorInfo($instructorInfo);

        $this->assertTrue($check1);
        $this->assertFalse($check2);
    }


    public function testDeleteInstructor() {


        $instructor = new Instructor('en', 1);
        $check = $instructor->deleteInstructorInfo();
        $this->assertTrue($check);
    }


    public static function tearDownAfterClass() {
        $dataclear = new InstructorsClear();
        $dataclear->run();
    }

}
