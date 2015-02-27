<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientTest
 *
 * @author Manager
 */
class ClientTest extends PHPUnit_Framework_TestCase {


    public static function setUpBeforeClass() {

        $dataup = new DatabaseSeeder();
        $dataup->run();
    }


    public function testInsertClientInfo() {

        $clientInfo = array(
            'id' => 'new',
            'active' => '0',
            'name' => 'review',
            'review' => '223'
        );

        $client = new Client('en');
        $check = $client->insertClientInfo($clientInfo);
        $this->assertTrue($check);
    }


    public function testSetUpClientReview() {
        $client = new Client('en', 1);
        $clientInfo = $client->setUpClientReview();

        $this->assertInternalType('int', $clientInfo['id']);
        $this->assertInternalType('string', $clientInfo['name']);
        $this->assertInternalType('string', $clientInfo['review']);
    }


    public function testSetUpClientsIdList() {
        $client = new Client('en');
        $clientIdList = $client->setUpClinetsIdList();
        foreach ($clientIdList as $name => $val) {
            $this->assertInternalType('int', $val);
        }
    }


    public function testUpdateClientInfo() {

        $clientInfo = array(
            'id' => '2',
            'active' => '1',
            'name' => 'sdfsdf',
            'review' => 'rew'
        );

        $client = new Client('en', 1);
        $clientF = new Client('ru', 11);

        $check1 = $client->updateClientInfo($clientInfo);
        $check2 = $clientF->updateClientInfo($clientInfo);

        $this->assertTrue($check1);
        $this->assertFalse($check2);
    }


    public function testDeleteClient() {


        $client = new Client('en', 1);
        $check = $client->deleteClientInfo();
        $this->assertTrue($check);
    }


    public static function tearDownAfterClass() {
        $dataclear = new DataClear();
        $dataclear->run();
    }

}
