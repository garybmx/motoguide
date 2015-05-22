<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PastTour
 *
 * @author Manager
 */
class PastTour extends Tour {

    protected $tourType;
    private $condition;
    protected $id;
    private $pastTourInfo = array(
        'tour_id' => '',
        'tourType_id' => '',
        'active' => '',
        'name' => '',
        'startTime' => '',
        'endTime' => '',
        'description' => '',
        'duration' => '',
        'level_id' => '',
        'location' => '',
        'review' => ''
    );


    function __construct($language, $id = null) {
        parent::__construct($language);
        $this->id = $id;
        $this->tourType = 2;
        $this->condition = new ConditionPast($this->language, $this->id);
    }


    /**
     * 
     * @return array
     * Function return array of all tours
     */
    
    public function setUpListToursInfo($select = array()) {
        $returnArray = array(0=> 'не определен');
        $result = parent::setUpAllToursInfo($select);
       
        foreach ($result as $value) {
            foreach ($value as $name => $val) {
                $returnArray[$value['tour_id']] = $val;
            }
        }
 
        return $returnArray;
    }
    
    public function setUpAllToursInfo($select = array()) {
        $result = parent::setUpAllToursInfo($select);
        return $result;
    }


    public function setUpTourInfo() {

        $tourInfo = $this->getFullTourInfo($this->id);
        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {
                $this->pastTourInfo[$name] = $val;
            }
        }

        $futureTour = $this->getPastTourInfo();
        foreach ($futureTour as $value1) {
            foreach ($value1 as $name1 => $val1) {
                $this->pastTourInfo[$name1] = $val1;
            }
        }

        return $this->pastTourInfo;
    }


    public function addTour($tourArray = array()) {
        
        $arrayCheck = $this->arrayCheck($tourArray, $this->pastTourInfo);
      
        if ((empty($tourArray)) || ($arrayCheck === false)) {
            return false;
        }
        $check = array();
       
        $id = $this->insertTourRecord($tourArray);
        $check[] = $this->checkReturnId($id);

        if (($this->langId === NULL) && (is_numeric($id))) {
            $check[] = $this->insertAnotherLanguage($id, $this->pastTourInfo);
        }

        $this->condition->setId($id);
        $check[] = $this->condition->insertConditionRecord($tourArray);
        $check[] = $this->condition->insertConditionPastRecord($tourArray);

        return $this->checkTrue($check);
    }


    public function updateTour($tourArray = array()) {
         
        $arrayCheck = $this->arrayCheck($tourArray, $this->pastTourInfo);
        $tourType = $this->tourTypeCheck();

        if ((empty($tourArray)) || ($arrayCheck === false) || ($tourType === false)) {
            return false;
        }
        $check = array();
        $check[] = $this->updateTourRecord($tourArray);
        
        $check[] = $this->condition->updateConditionPastRecord($tourArray);
        $check[] = $this->condition->updateConditionRecord($tourArray);
      
        
        return $this->checkUpdateTrue($check);
    }


    public function deleteTour() {
       

        $check = array();
        $check[] = $this->deleteTourRecord();
        $check[] = $this->condition->deleteConditionPastRecord();
        $check[] = $this->condition->deleteConditionRecord();

        if (($this->langId === NULL) && (is_numeric($this->id))) {
            $check[] = $this->deleteAnotherLanguage($this->id);
        }


        return $this->checkTrue($check);
    }

     protected function deleteAnotherLanguage($id) {

        $newTour = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newTour->setLangId($id);
       
        return $newTour->deleteTour();
    }

    private function getPastTourInfo() {

        if ($this->id != null) {
            return $this->condition->getAllCondition();
        }
        return array();
    }

       public function checkAndInsert() {
        $cnt = DB::table($this->table)->where('tour_id', $this->id)->count();
        if ($cnt == 0) {
           
            $this->setLangId($this->id);
            $this->addTour($this->pastTourInfo);
        } else {
            $newLevel = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $this->id);
            $newLevel->setLangId($this->id);

            $newLevel->checkAndInsert();
        }
    }
}
