<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConditionPast
 *
 * @author Manager
 */
class ConditionPast extends Condition {

    private $pastTable;
    protected $id;
    protected $language;


    function __construct($language, $id) {
        $this->id = $id;
        $this->language = $language;
        $this->pastTable = 'conditionpast_' . $this->language;

        parent::__construct($language, $this->id);
    }


    function setId($id) {
        $this->id = $id;
    }


    public function getAllCondition() {
        $condition = $this->getCondition();
        $futureCondition = $this->getPastCondition();
        return array_merge($condition, $futureCondition);
    }


    public function getCondition() {
        return parent::getCondition();
    }


    public function getPrice() {
        return $this->price->getAllPrices();
    }


    public function insertConditionPastRecord($tourArray) {
        $this->checkAndDeleteId($this->pastTable);
        return DB::table($this->pastTable)->insert(
                        array('tour_id' => $this->id,
                            'review' => $tourArray['review'])
        );
    }


    public function updateConditionPastRecord($tourArray) {

        $exist = DB::table($this->pastTable)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0) {
            return $this->insertConditionPastRecord($tourArray);
        }

        $check = DB::table($this->pastTable)->where('tour_id', $this->id)->update(
                array(
                    'review' => $tourArray['review'])
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteConditionPastRecord() {
        $exist = DB::table($this->pastTable)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0)
            return true;

        $check = $this->checkAndDeleteId($this->pastTable);

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    private function getPastCondition() {

        return DB::table($this->pastTable)
                        ->select('review')
                        ->where('tour_id', $this->id)
                        ->get();
    }

}
