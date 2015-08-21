<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author Manager
 */
class RequestTour extends Staff {

    private $requestTable;
    private $allRequestsInfo = array();
    private $requestInfo = array(
        'id' => null,
        'name' => '',
        'lastname' => '',
        'location' => '',
        'age' => '',
        'comments' => '',
        'phone' => '',
        'email' => '',
        'new' => 0,
        'date' => ''
    );
    protected $id;


    function __construct($id = null) {
        $this->id = $id;
        $this->requestTable = "request";
    }


    protected function getInfo($id) {
        return DB::table($this->requestTable)
                        ->where('id', $id)
                        ->get();
    }


    protected function getAllInfo() {
        return DB::table($this->requestTable)->orderBy('id', 'desc')->get();
    }


    public function setUpRequestInfo() {
        return parent::setUpInfo();
    }


    public function updateRequestInfo($requestArray = array()) {
        return parent::updateInfo($this->requestInfo, $requestArray);
    }


    public function setUpAllRequestsInfo() {
        return parent::setUpAllInfo();
    }


    public function setStatus() {
        DB::table($this->requestTable)
                ->where('id', $this->id)->update(array('new' => 0));
    }


    public function deleteRequestInfo() {
        $check = array();
        $check[] = $this->deleteRecord($this->id);
        return $this->checkTrue($check);
    }


    protected function insertRecord($insertArray) {
        return 0;
    }


    protected function updateRecord($requestArray) {
        $check = DB::table($this->requestTable)
                ->where('id', $this->id)
                ->update(array(
            'name' => $requestArray['name'],
            'lastname' => $requestArray['lastname'],
            'location' => $requestArray['location'],
            'age' => $requestArray['age'],
            'comments' => $requestArray['comments'],
            'email' => $requestArray['email'],
            'phone' => $requestArray['phone'],
            'new' => 0,
            'date' => $requestArray['date'],
                )
        );


        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRecord($id) {

        $check = DB::table($this->requestTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
