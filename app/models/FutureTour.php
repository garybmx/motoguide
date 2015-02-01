<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FutureTour
 * tourType_id for futureTour = 1; 
 * @author Manager
 */
class FutureTour extends Tour {

    protected $tourType;
    private $condition;
    protected $id;
    private $futureTourInfo = array(
        'tour_id' => '',
        'tourType_id' => '',
        'name' => '',
        'startTime' => '',
        'endTime' => '',
        'description' => '',
        'duration' => '',
        'level' => '',
        'location' => '',
        'residence' => '',
        'feed' => '',
        'price' => array()
    );


    function __construct($language, $id = null) {
        parent::__construct($language);
        $this->id = $id;
        $this->tourType = 1;
        $this->condition = new ConditionFuture($this->language, $this->id);
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


    /**
     * 
     * @return array
     * Function return array of information for one tour
     * 
     */
    public function setUpTourInfo() {

        $tourInfo = $this->getFullTourInfo($this->id);
        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {
                $this->futureTourInfo[$name] = $val;
            }
        }

        $futureTour = $this->getFutureTourInfo();

        foreach ($futureTour as $value1) {
            foreach ($value1 as $name1 => $val1) {
                $this->futureTourInfo[$name1] = $val1;
            }
        }

        $prices = $this->getTourPrices();

        foreach ($prices as $value2) {
            foreach ($value2 as $name2 => $val2) {
                $this->futureTourInfo['price'][$value2->price_id][$name2] = $val2;
            }
        }



        return $this->futureTourInfo;
    }


    public function addTour($tourArray = array()) {
        $arrayCheck = $this->arrayCheck($tourArray, $this->futureTourInfo);

        if ((empty($tourArray)) || ($arrayCheck === false)) {
            return false;
        }
        $check = array();
        $id = $this->insertTourRecord($tourArray);
        $check[] = $this->checkReturnId($id);
        $this->condition->setId($id);
        $check[] = $this->condition->insertConditionRecord($tourArray);
        $check[] = $this->condition->insertConditionFutureRecord($tourArray);
        $check[] = $this->condition->insertPrices($tourArray['price']);

        return $this->checkTrue($check);
    }
    
    
    public function updateTour($tourArray = array()) {
        $arrayCheck = $this->arrayCheck($tourArray, $this->futureTourInfo);
        $tourType = $this->tourTypeCheck();


        if ((empty($tourArray)) || ($arrayCheck === false) || ($tourType === false)) {
            return false;
        }

        if ($tourType === false) {
            return $this->changeType($tourArray);
        }

        $check = array();
        $check[] = $this->updateTourRecord($tourArray);
        $check[] = $this->condition->updateConditionFutureRecord($tourArray);
        $check[] = $this->condition->updateConditionRecord($tourArray);
        $check[] = $this->condition->updatePrices($tourArray['price']);

        return $this->checkTrue($check);
    }


    public function deleteTour() {
        $tourType = $this->tourTypeCheck();
        if ($tourType === false) {
            return false;
        }
        
        $check = array();
        $check[] = $this->deleteTourRecord();
        $check[] = $this->condition->deleteConditionFutureRecord();
        $check[] = $this->condition->deleteConditionRecord();
        $check[] = $this->condition->deletePriceRecords();

        return $this->checkTrue($check);
    }


    public function deleteOnePriceRecord($priceId) {
        $this->condition->deleteOnePriceRecord($priceId);
    }


    private function addAnotherLanguageTour($addId){
        $tour = new FutureTour('ru');
        $tour->setAddId($addId);
        $tour->addTour($this->futureTourInfo);
        
    }
    /**
     * 
     * @return array
     * Function return array of object of conditions for tour
     */
    private function getFutureTourInfo() {

        if ($this->id != null) {
            return $this->condition->getAllCondition();
        }
        return array();
    }


    /**
     * 
     * @return array
     * Function return array of object of prices for tour
     */
    private function getTourPrices() {

        if ($this->id != null) {
            return $this->condition->getPrice();
        }
        return array();
    }

}
