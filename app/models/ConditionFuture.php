<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConditionFuture
 *
 * @author Manager
 */
class ConditionFuture extends Condition {

    private $futureTable;
    private $price;
    protected $language;


    function __construct($language, $id) {
        $this->id = $id;
        $this->language = $language;
        $this->futureTable = 'conditionFuture_' . $this->language;
        $this->price = new Price($language, $this->id);

        parent::__construct($language, $this->id);
    }


    function setId($id) {
        $this->id = $id;
        $this->price->setId($id);
    }


    public function getAllCondition() {
        $condition = $this->getCondition();
        $futureCondition = $this->getFutureCondition();
        return array_merge($condition, $futureCondition);
    }


    public function getCondition() {
        return parent::getCondition();
    }


    public function getPrice() {
        return $this->price->getAllPrices();
    }


    public function deletePriceRecords() {
        return $this->price->deletePriceRecords();
    }


    public function deleteOnePriceRecord($priceId) {
        return $this->price->deleteOnePriceRecord($priceId);
    }


    public function insertPrices($priceArray) {
        $this->price->insertPrices($priceArray);
    }


    public function updatePrices($priceArray) {
        $this->price->updatePrices($priceArray);
    }


    public function insertConditionFutureRecord($tourArray) {
        $this->checkAndDeleteId($this->futureTable);
        return DB::table($this->futureTable)->insert(
                        array('tour_id' => $this->id,
                            'residence' => $tourArray['residence'],
                            'feed' => $tourArray['feed'])
        );
    }


    public function updateConditionFutureRecord($tourArray) {

        $exist = DB::table($this->futureTable)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0) {
            return $this->insertConditionFutureRecord($tourArray);
        }

        $check = DB::table($this->futureTable)->where('tour_id', $this->id)->update(
                array(
                    'residence' => $tourArray['residence'],
                    'feed' => $tourArray['feed'])
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteConditionFutureRecord() {
        $exist = DB::table($this->futureTable)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0)
            return true;

        $check = $this->checkAndDeleteId($this->futureTable);

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    private function getFutureCondition() {
        return DB::table($this->futureTable)->where('tour_id', $this->id)->get();
    }

}
