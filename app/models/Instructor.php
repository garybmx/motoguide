<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Instructor
 *
 * @author Manager
 */
class Instructor extends Staff {

    private $language;
    private $instructorTable;
    private $instuctorInfo = array(
        'id' => '',
        'active' => '',
        'name' => '',
        'lastname' => '',
        'age' => '',
        'expirience' => '',
    );
    protected $langId;
    protected $id;


    function __construct($language, $id = null) {
        $this->id = $id;
        $this->language = $language;
        $this->instructorTable = "instructors_" . $this->language;
        $this->langId = null;
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function setUpInstructorInfo() {
        return parent::setUpInfo();
    }


    public function setUpAllMotorcylesInfo() {
        return parent::setUpAllInfo();
    }


    public function insertInstructorInfo($instructorArray = array()) {
        return parent::insertInfo($this->instuctorInfo, $this->langId, $instructorArray);
    }


    public function updateInstructorInfo($instructorArray = array()) {
        return parent::updateInfo($this->instuctorInfo, $instructorArray);
    }


    public function deleteInstructorInfo() {
        return parent::deleteInfo();
    }


    public function checkAndInsert() {
        $cnt = DB::table($this->instructorTable)->where('id', $this->id)->count();
        if ($cnt == 0) {
            $this->setLangId($this->id);
            $this->insertInstructorInfo($this->instuctorInfo);
        } else {
            $newInstructor = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $this->id);
            $newInstructor->setLangId($this->id);
            $newInstructor->checkAndInsert();
        }
    }
    
    protected function getInfo($id) {
        return DB::table($this->instructorTable)
                        ->where('id', $id)
                        ->get();
    }


    protected function getAllInfo() {
        return DB::table($this->instructorTable)->get();
    }


    protected function insertAnotherLanguage($getId) {
        $newInstructor = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newInstructor->setLangId($getId);
        $newInstructor->checkAndDeleteId($newInstructor->instructorTable, $getId, 'id');
        return $newInstructor->insertInstructorInfo($this->instuctorInfo);
    }


    protected function deleteAnotherLanguage($id) {
        $newInstructor = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language,  $id);
        $newInstructor->setLangId($id);
        return $newInstructor->deleteInstructorInfo();
    }


    protected function insertRecord($insertArray) {
        return DB::table($this->instructorTable)->insertGetId(
                        array('id' => $this->langId,
                            'active' => $insertArray['active'],
                            'name' => $insertArray['name'],
                            'lastname' => $insertArray['lastname'],
                            'age' => $insertArray['age'],
                            'expirience' => $insertArray['expirience']
        ));
    }


    protected function updateRecord($insertArray) {
        $check = DB::table($this->instructorTable)
                ->where('id', $this->id)
                ->update(array(
            'active' => $insertArray['active'],
            'name' => $insertArray['name'],
            'lastname' => $insertArray['lastname'],
            'age' => $insertArray['age'],
            'expirience' => $insertArray['expirience']
                )
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteRecord($id) {
        $cnt = DB::table($this->instructorTable)->where('id', $id)->count();
        if ($cnt == 0) {
            return true;
        }
        $check = DB::table($this->instructorTable)->where('id', $id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

}
