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
class ClientTest extends TestCase {

    public static function setUpBeforeClass() {
    $dataup = new DatabaseSeeder();
      $dataup->run();
    }

    public function testSetUpClientReview() {
        $client = new Client('en');
        $clientInfo = $client->setUpClientReview('1');

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

    public static function tearDownAfterClass() {
        $dataclear = new DataClear();
        $dataclear->run();
    }

}
