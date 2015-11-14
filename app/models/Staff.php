<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of People
 *
 * @author Manager
 */
abstract class Staff {

    protected $id;
    protected $langId;


    protected function arrayCheck($checkArray, $defaultArray) {

        $returnArray = array_diff_key($checkArray, $defaultArray);

        if (empty($returnArray)) {
            return true;
        } else {
            return false;
        }
    }


    protected function checkTrue($check = array()) {
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


    protected function checkById($checkId) {
        if (is_numeric($checkId)) {
            return true;
        } else {
            return false;
        }
    }


    protected function checkAndDeleteId($table, $id, $fieldName) {
        $cnt = DB::table($table)->where($fieldName, $id)->count();

        if ($cnt != 0) {
            return DB::table($table)->where($fieldName, $id)->delete();
        }
    }


    protected function setUpInfo($isactive = NULL) {

        $returnArray = array();
        $Info = $this->getInfo($this->id, $isactive);
        if (empty($Info)) {
            return FALSE;
        }

        foreach ($Info as $value) {
            foreach ($value as $name => $val) {
                $returnArray[$name] = $val;
            }
        }


        return $returnArray;
    }


    abstract protected function getInfo($id);


    protected function setUpAllInfo($isactive = null, $paginate = null) {
        $returnArray = array();
        $Info = $this->getAllInfo($isactive, $paginate);
        foreach ($Info as $value) {
            foreach ($value as $name => $val) {

                $returnArray[$value->id][$name] = $val;
            }
        }

        return $returnArray;
    }


    abstract protected function getAllInfo($isactive = null);


    protected function insertInfo($defaultArray, $langId, $insertArray = array()) {

        $arrayCheck = $this->arrayCheck($insertArray, $defaultArray);
        if (empty($insertArray) || $arrayCheck === false) {
            return false;
        }

        $check = array();

        $getId = $this->insertRecord($insertArray);

        $check[] = $this->checkById($getId);

        if (($langId === NULL) && (is_numeric($getId))) {
            $check[] = $this->insertAnotherLanguage($getId);
        }

        return $this->checkTrue($check);
    }


    abstract protected function insertRecord($insertArray);


    protected function deleteInfo() {

        $check = array();
        $check[] = $this->deleteRecord($this->id);

        if (($this->langId === NULL) && (is_numeric($this->id))) {
            $check[] = $this->deleteAnotherLanguage($this->id);
        }

        return $this->checkTrue($check);
    }


    abstract protected function deleteRecord($id);


    protected function updateInfo($defaultArray, $insertArray = array()) {

        $arrayCheck = $this->arrayCheck($insertArray, $defaultArray);
        if (empty($insertArray) || $arrayCheck === false) {
            return false;
        }

        $check = $this->updateRecord($insertArray);

        return $check;
    }


    abstract protected function updateRecord($insertArray);
}
