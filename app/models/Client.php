<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Client
 *
 * @author Manager
 */
class Client {

    private $clientTable;
    private $language;


    public function __construct($language) {
        $this->language = $language;
        $this->clientTable = 'clients_' . $this->language;
    }


    public function setUpClientReview($id) {
        $returnArray = array();
        $clientReview = $this->getClientReview($id);
        foreach ($clientReview as $value1) {
            foreach ($value1 as $name1 => $val1) {
                $returnArray[$name1] = $val1;
            }
        }

        return $returnArray;
    }


    public function setUpClinetsIdList() {
        $returnArray = array();
        $idList = $this->getClientsId();

        foreach ($idList as $value1) {
            foreach ($value1 as $name1 => $val1) {
                $returnArray[] = $val1;
            }
        }

        return $returnArray;
    }


    private function getClientReview($id) {
        return DB::table($this->clientTable)
                        ->select('id', 'name', 'review')
                        ->where('id', $id)
                        ->get();
    }


    public function getClientsId() {
        return DB::table($this->clientTable)
                        ->select('id')
                        ->get();
    }

}
