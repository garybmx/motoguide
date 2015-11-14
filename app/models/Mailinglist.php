<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailinglist
 *
 * @author Manager
 */
class Mailinglist extends Staff {

    private $mailinglistTable;
    private $allMailinglistsInfo = array();
    private $mailinglistInfo = array(
        'id' => null,
        'email' => '',
        'lang' => 0,
    );
    protected $id;


    function __construct($id = null) {
        $this->id = $id;
        $this->mailinglistTable = "mailinglist";
    }


    protected function getInfo($id) {
        return DB::table($this->mailinglistTable)
                        ->where('id', $id)
                        ->get();
    }


    protected function getListInfo($lang) {
        return DB::table($this->mailinglistTable)
                        ->where('lang', $lang)
                        ->select('email')
                        ->get();
    }


    protected function getAllInfo($isactive = NULL) {
        return DB::table($this->mailinglistTable)->orderBy('id', 'desc')->get();
    }


    public function setUpMailinglistInfo($lang) {

        $returnString = '';
        $Info = $this->getListInfo($lang);
        if (empty($Info)) {
            return 'нет адресов для рассылки';
        }

        foreach ($Info as $value) {
            foreach ($value as $name => $val) {
                $returnString .= $val . ', ';
            }
        }


        return $returnString;
    }


    public function setUpInfo($isactive = NULL) {

        return parent::setUpInfo($isactive);
    }


    public function setUpAllMailinglistsInfo($isactive = NULL) {
        return parent::setUpAllInfo($isactive);
    }


    public function insertMailinglistInfo($mailinglistArray = array()) {
        return $this->insertRecord($mailinglistArray);
    }


    public function updateMailinglistInfo($mailinglistArray = array()) {
        return parent::updateInfo($this->mailinglistInfo, $mailinglistArray);
    }


    public function deleteMailinglistInfo() {
        $check = array();
        $check[] = $this->deleteRecord($this->id);
        return $this->checkTrue($check);
    }


    protected function insertRecord($insertArray) {
      
        return DB::table($this->mailinglistTable)->insertGetId(
                        array(
                            'email' => $insertArray['email'],
                            'lang' => $insertArray['lang']
        ));
    }


    protected function updateRecord($mailinglistArray) {
        $check = DB::table($this->mailinglistTable)
                ->where('id', $this->id)
                ->update(array(
            'email' => $mailinglistArray['email'],
            'lang' => $mailinglistArray['lang']
                )
        );


        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRecord($id) {

        $check = DB::table($this->mailinglistTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
