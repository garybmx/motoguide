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
        'tour_id' => '',
        'active' => '',
        'name' => '',
        'review' => ''
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


    public function setUpClientInfo() {
        return parent::setUpInfo();
    }


    public function setUpAllClientsInfo($isactive = null) {
        return parent::setUpAllInfo($isactive);
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


    public function checkAndInsert() {
        $cnt = DB::table($this->clientTable)->where('id', $this->id)->count();
        if ($cnt == 0) {
            $this->setLangId($this->id);
            $this->insertClientInfo($this->clientInfo);
        } else {
            $newInstructor = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $this->id);
            $newInstructor->setLangId($this->id);
            $newInstructor->checkAndInsert();
        }
    }

    public function getClientTourId() {
        $cnt = DB::table('clients_tour')->where('client_id', $this->id)->count();
        if ($cnt == 0) {
            return 0;
        } else {
            $return = DB::table('clients_tour')->select('tour_id')
                        ->where('client_id', $this->id)
                        ->get();
            
            return $return[0]->tour_id;
        }
        
    }
    
    public function setUpRandomClient() {
        $returnArray = array();
        $Info = $this->getRandomClient();
        foreach ($Info as $value) {
            foreach ($value as $name => $val) {

                $returnArray[$value->id][$name] = $val;
            }
        }

        return $returnArray;
    }
    
    protected function getRandomClient(){
        return DB::table($this->clientTable)->where('active', 1)->orderBy(DB::raw('RAND()'))->take(2)->get();
    }


    protected function getInfo($id) {

        return DB::table($this->clientTable)
                        ->where('id', $id)
                        ->get();
    }


    protected function getAllInfo($isactive = null) {
        return DB::table($this->clientTable)->get();
    }


    protected function insertAnotherLanguage($getId) {
        $newClient = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newClient->setLangId($getId);
        $newClient->checkAndDeleteId($newClient->clientTable, $getId, 'id');
        return $newClient->insertClientInfo($this->clientInfo);
    }


    protected function deleteAnotherLanguage($id) {
        $newClient = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newClient->setLangId($id);
        return $newClient->deleteClientInfo();
    }


    protected function insertRecord($insertArray) {

        $getId = DB::table($this->clientTable)->insertGetId(
                array('id' => $this->langId,
                    'active' => $insertArray['active'],
                    'name' => $insertArray['name'],
                    'review' => $insertArray['review']
        ));
        if ($this->langId == null) {
            DB::insert('insert into `clients_tour` (`client_id`, `tour_id`) values (?, ?)
             on duplicate key update `tour_id`=values(`tour_id`)', array($getId, (int) $insertArray['tour_id'])
            );
        }

        return $getId;
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

        if ($this->langId == null) {
            DB::insert('insert into `clients_tour` (`client_id`, `tour_id`) values (?, ?)
             on duplicate key update `tour_id`=values(`tour_id`)', array($this->id, (int) $insertArray['tour_id'])
            );
            $check = 1;
        }
        
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
        $this->deleteClientTourRecord();
        $check = DB::table($this->clientTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteClientTourRecord() {
        $cnt = DB::table('clients_tour')->where('client_id', $this->id)->count();
        if ($cnt == 0) {
            return true;
        }
       
        $check = DB::table('clients_tour')->where('client_id', $this->id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
