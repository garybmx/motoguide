<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tour
 *
 * @author Manager
 */
abstract class Tour {

    protected $table;
    protected $language;
    protected $allToursInfo = array();
    protected $tourType;


    /**
     * @return int Return id of the tour
     */
    function __construct($language) {
        $this->language = $language;
        $this->table = 'tours_' . $this->language;
    }


    public function setUpAllToursInfo() {
        $tourInfo = $this->getAllTour($this->tourType);
        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {

                $this->allToursInfo[$value->tour_id][$name] = $val;
            }
        }

        return $this->allToursInfo;
    }


    function getFullTourInfo($id) {

        return DB::select('select * from ' . $this->table . ' where `tour_id`=' . $id);
    }


    function getAllTour() {
        return DB::select('select * from ' . $this->table . ' where `tourType_id`=' . $this->tourType);
    }


    protected function arrayCheck($checkArray, $defaultArray) {

        $returnArray = array_diff_key($checkArray, $defaultArray);

        if (empty($returnArray)) {
            return true;
        } else {
            return false;
        }
    }


    protected function insertTourRecord($tourArray) {
        return $id = DB::table($this->table)->insertGetId(
                array('tourType_id' => $this->tourType,
                    'name' => $tourArray['name'],
                    'startTime' => $tourArray['startTime'],
                    'endTime' => $tourArray['endTime'],
                    'description' => $tourArray['description'])
        );
    }


    protected function checkReturnId($id) {
        if (is_numeric($id)) {
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


    protected function updateTourRecord($tourArray) {
        $check = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->update(array(
            'name' => $tourArray['name'],
            'startTime' => $tourArray['startTime'],
            'endTime' => $tourArray['endTime'],
            'description' => $tourArray['description'])
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteTourRecord() {
        $check = DB::table($this->table)->where('tour_id', $this->id)->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function tourTypeCheck() {
        $checkType = $this->getType();
     
        if ($this->tourType != $checkType) {
            return false;
        } else {
            return true;
        }
    }

    private function getType(){
        $array =DB::table($this->table)
                ->select('tourType_id')
                ->where('tour_id', $this->id)
            ->get();
        
        return $array[0]->tourType_id;
    }
}
