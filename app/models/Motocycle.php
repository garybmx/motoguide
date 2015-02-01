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
class Motocycle {

    private $language;
    private $motorTable;
    private $langId;
    private $id;
    private $allMotorcyclesInfo = array();
    private $motorcycleInfo = array(
        'id' => '',
        'active' => '',
        'model' => '',
        'power' => '',
        'weight' => '',
        'description' => '',
    );


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

        $MotorcycleInfo = $this->getMotorcycleInfo($this->id);
        if (empty($MotorcycleInfo)) {
            return FALSE;
        }

        foreach ($MotorcycleInfo as $value) {
            foreach ($value as $name => $val) {
                $this->motorcycleInfo[$name] = $val;
            }
        }

        return $this->motorcycleInfo;
    }


    public function setUpAllMotorcylesInfo() {
        $motorInfo = $this->getAllMotorcycles();
        foreach ($motorInfo as $value) {
            foreach ($value as $name => $val) {

                $this->allMotorcyclesInfo[$value->id][$name] = $val;
            }
        }

        return $this->allMotorcyclesInfo;
    }


    public function insertMotorcycleInfo($motorcycleArray = array()) {

        $arrayCheck = $this->arrayCheck($motorcycleArray, $this->motorcycleInfo);
        if (empty($motorcycleArray) || $arrayCheck === false) {
            return false;
        }

        $check = array();

        $getId = $this->insertMotorcycleRecord($motorcycleArray);
        $check[] = $this->checkById($getId);

        if (($this->langId === NULL) && (is_numeric($getId))) {
            $check[] = $this->insertAnotherLanguage($getId);
        }

        return $this->checkTrue($check);
    }


    public function updateMotorcycleInfo($motorcycleArray = array()) {

        $arrayCheck = $this->arrayCheck($motorcycleArray, $this->motorcycleInfo);
        if (empty($motorcycleArray) || $arrayCheck === false) {
            return false;
        }

      

        $check = $this->updateMotorcycleRecord($motorcycleArray);


        return $check;
    }


    public function deleteMotorcycleInfo() {

        $check = array();
        $check[] = $this->deleteMotorcycleRecord($this->id);

        if (($this->langId === NULL) && (is_numeric($this->id))) {
            $check[] = $this->deleteAnotherLanguage($this->id);
        }

        return $this->checkTrue($check);
    }


    function getMotorcycleInfo($id) {

        return DB::table($this->motorTable)
                        ->where('id', $id)
                        ->get();
    }


    private function updateMotorcycleRecord($motorArray) {
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


    private function getAllMotorcycles() {
        return DB::table($this->motorTable)->get();
    }


    private function insertAnotherLanguage($getId) {

        $newMotorcycle = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newMotorcycle->setLangId($getId);
        $newMotorcycle->checkAndDeleteId($getId);
        return $newMotorcycle->insertMotorcycleInfo($this->motorcycleInfo);
    }


    private function deleteAnotherLanguage($id) {

        $newMotorcycle = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newMotorcycle->setLangId($id);
        return $newMotorcycle->deleteMotorcycleInfo();
    }


    private function arrayCheck($checkArray, $defaultArray) {

        $returnArray = array_diff_key($checkArray, $defaultArray);

        if (empty($returnArray)) {
            return true;
        } else {
            return false;
        }
    }


    private function insertMotorcycleRecord($insertArray) {

        return DB::table($this->motorTable)->insertGetId(
                        array('id' => $this->langId,
                            'active' => $insertArray['active'],
                            'model' => $insertArray['model'],
                            'power' => $insertArray['power'],
                            'weight' => $insertArray['weight'],
                            'description' => $insertArray['description']
        ));
    }


    private function deleteMotorcycleRecord($id) {
        $check = DB::table($this->table)->where('tour_id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    private function checkById($checkId) {
        if (is_numeric($checkId)) {
            return true;
        } else {
            return false;
        }
    }


    private function checkTrue($check = array()) {
        if (empty($check)) {
            return false;
        }

        foreach ($check as $name => $value) {
            if ($value === false) {
                return false;
            }
        }

        return true;
    }


    private function checkAndDeleteId($id) {
        $cnt = DB::table($this->motorTable)->where('id', $id)->count();
        if ($cnt != 0) {
            return DB::table($this->motorTable)->where('id', $id)->delete();
        }
    }

}
