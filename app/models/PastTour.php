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
        'name' => '',
        'startTime' => '',
        'endTime' => '',
        'description' => '',
        'duration' => '',
        'level' => '',
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
    public function setUpAllToursInfo() {
        $result = parent::setUpAllToursInfo($this->tourType);
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

        return $this->checkTrue($check);
    }


    public function deleteTour() {
        $tourType = $this->tourTypeCheck();
        if ($tourType === false) {
            return false;
        }

        $check = array();
        $check[] = $this->deleteTourRecord();
        $check[] = $this->condition->deleteConditionPastRecord();
        $check[] = $this->condition->deleteConditionRecord();
        return $this->checkTrue($check);
    }


    private function getPastTourInfo() {

        if ($this->id != null) {
            return $this->condition->getAllCondition();
        }
        return array();
    }

}
