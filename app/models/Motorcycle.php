<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Motocycle
 *
 * @author Manager
 */
class Motorcycle extends Staff {

    private $language;
    private $motorTable;
    private $allMotorcyclesInfo = array();
    private $motorcycleInfo = array(
        'id' => '',
        'active' => '',
        'model' => '',
        'power' => '',
        'weight' => '',
        'description' => '',
    );
    protected $langId;
    protected $id;


    function __construct($language, $id = null) {
        $this->id = $id;
        $this->language = $language;
        $this->motorTable = "motorcycles_" . $this->language;
        $this->langId = null;
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function setUpMotorcycleInfo() {
        return parent::setUpInfo();
    }


    public function setUpAllMotorcylesInfo() {
        return parent::setUpAllInfo();
    }


    public function insertMotorcycleInfo($motorcycleArray = array()) {
        return parent::insertInfo($this->motorcycleInfo, $this->langId, $motorcycleArray);
    }


    public function updateMotorcycleInfo($motorcycleArray = array()) {
        return parent::updateInfo($this->motorcycleInfo, $motorcycleArray);
    }


    public function deleteMotorcycleInfo() {
        return parent::deleteInfo();
    }


    public function checkAndInsert() {
        $cnt = DB::table($this->motorTable)->where('id', $this->id)->count();
        if ($cnt == 0) {
            $this->setLangId($this->id);
            $this->insertMotorcycleInfo($this->motorcycleInfo);
        } else {
            $newMotorcycle = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $this->id);
            $newMotorcycle->setLangId($this->id);
            $newMotorcycle->checkAndInsert();
        }
    }


    protected function getInfo($id) {
        return DB::table($this->motorTable)
                        ->where('id', $id)
                        ->get();
    }


    protected function getAllInfo() {
        return DB::table($this->motorTable)->get();
    }


    protected function insertAnotherLanguage($getId) {
        $newMotorcycle = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newMotorcycle->setLangId($getId);
        $newMotorcycle->checkAndDeleteId($newMotorcycle->motorTable, $getId, 'id');
        return $newMotorcycle->insertMotorcycleInfo($this->motorcycleInfo);
    }


    protected function deleteAnotherLanguage($id) {
        $newMotorcycle = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newMotorcycle->setLangId($id);
        return $newMotorcycle->deleteMotorcycleInfo();
    }


    protected function insertRecord($insertArray) {
        return DB::table($this->motorTable)->insertGetId(
                        array('id' => $this->langId,
                            'active' => $insertArray['active'],
                            'model' => $insertArray['model'],
                            'power' => $insertArray['power'],
                            'weight' => $insertArray['weight'],
                            'description' => $insertArray['description']
        ));
    }


    protected function updateRecord($motorArray) {
        $check = DB::table($this->motorTable)
                ->where('id', $this->id)
                ->update(array(
            'model' => $motorArray['model'],
            'active' => $motorArray['active'],
            'power' => $motorArray['power'],
            'weight' => $motorArray['weight'],
            'description' => $motorArray['description']
                )
        );

        
        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRecord($id) {
        $cnt = DB::table($this->motorTable)->where('id', $id)->count();
        if ($cnt == 0) {
            return true;
        }
        $check = DB::table($this->motorTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
