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
    protected $id;
    protected $language;

    function __construct($language, $id) {
        $this->id = $id;
        $this->language = $language;
        $this->futureTable = 'conditionFuture_' . $this->language;
        $this->price = new Price($language, $this->id);

        parent::__construct($language, $this->id);
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

    private function getFutureCondition() {
        return DB::select('select * from ' . $this->futureTable . ' where tour_id = "' . $this->id . '"');
    }

}
