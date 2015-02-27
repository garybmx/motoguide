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
class Client extends Staff {

    private $language;
    private $clientTable;
    private $allClientsInfo = array();
    private $clientInfo = array(
        'id' => '',
        'active' => '',
        'name' => '',
        'review' => '',
    );
    protected $langId;
    protected $id;


    function __construct($language, $id = null) {
        $this->id = $id;
        $this->language = $language;
        $this->clientTable = "clients_" . $this->language;
        $this->langId = null;
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function setUpClientReview() {
        return parent::setUpInfo();
    }


    public function setUpAllClientsInfo() {
        return parent::setUpAllInfo();
    }


    public function insertClientInfo($clientArray = array()) {
        return parent::insertInfo($this->clientInfo, $this->langId, $clientArray);
    }


    public function updateClientInfo($clientArray = array()) {
        return parent::updateInfo($this->clientInfo, $clientArray);
    }


    public function deleteClientInfo() {
        return parent::deleteInfo();
    }


    public function setUpClinetsIdList() {
        return DB::table($this->clientTable)->lists('id');
    }


    protected function getInfo($id) {

        return DB::table($this->clientTable)
                        ->where('id', $id)
                        ->get();
    }


    protected function getAllInfo() {
        return DB::table($this->clientTable)->get();
    }


    protected function insertAnotherLanguage($getId) {
        $newClient = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newClient->setLangId($getId);
        $newClient->checkAndDeleteId($newClient->clientTable, $getId, 'id');
        return $newClient->insertClientInfo($this->clientInfo);
    }


    protected function deleteAnotherLanguage($id) {
        $newClient = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language,  $id);
        $newClient->setLangId($id);
        return $newClient->deleteClientInfo();
    }


    protected function insertRecord($insertArray) {
        return DB::table($this->clientTable)->insertGetId(
                        array('id' => $this->langId,
                            'active' => $insertArray['active'],
                            'name' => $insertArray['name'],
                            'review' => $insertArray['review']
        ));
    }


    protected function updateRecord($insertArray) {
        $check = DB::table($this->clientTable)
                ->where('id', $this->id)
                ->update(array(
            'active' => $insertArray['active'],
            'name' => $insertArray['name'],
            'review' => $insertArray['review']
                )
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRecord($id) {
        $cnt = DB::table($this->clientTable)->where('id', $id)->count();
        if ($cnt == 0) {
            return true;
        }
        $check = DB::table($this->clientTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
