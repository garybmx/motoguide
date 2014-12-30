<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FutureTour
 *
 * @author Manager
 */
class FutureTour extends Tour {

    private $condition;
    private $id;
    private $futureTourInfo = array('name' => '',
        'startTime' => '',
        'endTime' => '',
        'description' => '',
        'duration' => '',
        'level_id' => '',
        'location' => '',
        'residence' => '',
        'feed' => '',
        'price' => array()
    );
    private $allToursInfo = array();
            

    function __construct($language, $id = null) {
        parent::__construct($language);
        $this->id = $id;

        if ($this->id != null) {
            $this->condition = new ConditionFuture($this->language, $this->id);
        }
    }
    public function setUpAllToursInfo(){
        $tourInfo = $this->getAllTour(1);
        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {
                $this->allToursInfo[$value->tour_id][$name] = $val;
            }
        }

        return $this->allToursInfo;
        
    }

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

        
     //   var_dump($this->futureTourInfo);
        return $this->futureTourInfo;
    }

    private function getFutureTourInfo() {

        if ($this->id != null) {
            return $this->condition->getAllCondition();
        }
        return array();
    }
    
    private function getTourPrices() {

        if ($this->id != null) {
            return $this->condition->getPrice();
        }
        return array();
    }
    
}
