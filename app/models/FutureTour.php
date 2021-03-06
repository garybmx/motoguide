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
    protected $paginate;
    private $condition;
    protected $id;
    private $futureTourInfo = array(
        'tour_id' => '',
        'active' => '',
        'tourType_id' => '',
        'name' => '',
        'startTime' => '',
        'endTime' => '',
        'nodate' => '',
        'nodateactive' => '',
        'description' => '',
        'duration' => '',
        'level_id' => '',
        'location' => '',
        'residence' => '',
        'feed' => '',
    );


    function __construct($language, $id = null) {
        parent::__construct($language);
        $this->id = $id;
        $this->tourType = 1;
        $this->condition = new ConditionFuture($this->language, $this->id);
        $this->langId = null;
        $this->paginate = 2;
    }


    /**
     * 
     * @return array
     * Function return array of all tours
     */
    public function setUpAllToursInfo($select = array(), $isactive = null, $num = null) {
        $result = parent::setUpAllToursInfo($select, $isactive, $num);
        return $result;
    }


    public function setUpShortTourInfo($active = null) {

        $tourInfo = $this->getFullTourInfo($this->id, array(), $active);
        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {
                $this->futureTourInfo[$name] = $val;
            }
        }
        return $this->futureTourInfo;
    }


    /**
     * 
     * @return array
     * Function return array of information for one tour
     * 
     */
    public function setUpTourInfo($isactive = null) {

        $tourInfo = $this->getFullTourInfo($this->id);
        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {
                $this->futureTourInfo[$name] = $val;
            }
        }

        if ($isactive != null) {
            if ($this->futureTourInfo['active'] != 1) {
                return array();
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

        if (($this->langId === NULL) && (is_numeric($id))) {
            $check[] = $this->insertAnotherLanguage($id, $this->futureTourInfo);
        }

        $this->condition->setId($id);
        $check[] = $this->condition->insertConditionRecord($tourArray);
        $check[] = $this->condition->insertConditionFutureRecord($tourArray);


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


        return $this->checkUpdateTrue($check);
    }


    public function deleteTour() {

        $check = array();
        $check[] = $this->deleteTourRecord();
        $check[] = $this->condition->deleteConditionFutureRecord();
        $check[] = $this->condition->deleteConditionRecord();
        $check[] = $this->condition->deletePriceRecords();

        if (($this->langId === NULL) && (is_numeric($this->id))) {
            $check[] = $this->deleteAnotherLanguage($this->id);
        }

        return $this->checkTrue($check);
    }


    public function deleteOnePriceRecord($priceId) {
        $this->condition->deleteOnePriceRecord($priceId);
    }


    public function changeType() {
        $check = array();
        $check[] = $this->changeTypeId();
        $check[] = $this->condition->deleteConditionFutureRecord();
        $check[] = $this->condition->deletePriceRecords();

        $past = new ConditionPast($this->language, $this->id);
        $insertArray = array();
        $insertArray['review'] = '';
        $check[] = $past->insertConditionPastRecord($insertArray);

        if (($this->langId === NULL) && (is_numeric($this->id))) {
            $check[] = $this->changeAnotherLanguage($this->id);
        }

        return $this->checkTrue($check);
    }


    public function getPrices($id) {


        $price = new Price($this->language, $id);
        $getPrice = $price->getAllPrices();

        if (!empty($getPrice)) {
            $i = 1;
            foreach ($getPrice as $prices) {
                $priceArray[$i]['num'] = $i;
                $priceArray[$i]['name'] = $prices->price_name;
                $priceArray[$i]['price_id'] = $prices->price_id;
                $priceArray[$i]['price'] = $prices->price;
                $priceArray[$i]['description'] = $prices->description;
                $i++;
            }
        } else {
            $priceArray[1]['num'] = 1;
            $priceArray[1]['name'] = '';
            $priceArray[1]['price'] = '';
            $priceArray[1]['price_id'] = '';
            $priceArray[1]['description'] = '';
        }
        return $priceArray;
    }


    


    protected function deleteAnotherLanguage($id) {

        $newTour = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newTour->setLangId($id);

        return $newTour->deleteTour();
    }


    protected function changeAnotherLanguage($id) {

        $newTour = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language, $id);
        $newTour->setLangId($id);

        return $newTour->changeType();
    }


    protected function changeTypeId() {
        $check = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->update(array(
            'tourType_id' => 2)
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
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
