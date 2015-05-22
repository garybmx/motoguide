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
    protected $langId;


    /**
     * @return int Return id of the tour
     */
    function __construct($language) {
        $this->language = $language;
        $this->table = 'tours_' . $this->language;
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function setUpAllToursInfo($select = array()) {
        $tourInfo = $this->getAllTour($select);
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


    function getAllTour($select = array()) {
        if (empty($select)) {
            return DB::table($this->table)
                            ->where('tourType_id', $this->tourType)
                            ->get();
        } else {

            $selectString = "`" . implode("`,`", $select) . "`";
            return DB::select('select ' . $selectString . ' from ' . $this->table . ' where `tourType_id`=' . $this->tourType);
           
        }
    }


    protected function insertAnotherLanguage($getId, $addArray) {

        $newTour = addMultiLanguageService::getAnotherLanguageObj(get_class($this), $this->language);
        $newTour->setLangId($getId);
        $newTour->checkAndDeleteId($getId);
        return $newTour->addTour($addArray);
    }


    protected function checkAndDeleteId($id) {
        $cnt = DB::table($this->table)->where('tour_id', $id)->count();
        if ($cnt != 0) {
            return DB::table($this->table)->where('tour_id', $id)->delete();
        }
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
                array(
                    'tour_id' => $this->langId,
                    'tourType_id' => $this->tourType,
                    'name' => $tourArray['name'],
                    'startTime' => $tourArray['startTime'],
                    'endTime' => $tourArray['endTime'],
                    'description' => $tourArray['description'],
                    'active' => $tourArray['active'])
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


    protected function checkUpdateTrue($check = array()) {
        if (empty($check)) {
            return false;
        }

        foreach ($check as $name => $value) {
            if ($value === true) {
                return true;
            }
        }

        return false;
    }


    protected function updateTourRecord($tourArray) {
        $check = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->update(array(
            'name' => $tourArray['name'],
            'startTime' => $tourArray['startTime'],
            'endTime' => $tourArray['endTime'],
            'description' => $tourArray['description'],
            'active' => $tourArray['active'])
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function deleteTourRecord() {

        $cnt = DB::table($this->table)->where('tour_id', $this->id)->count();
        if ($cnt == 0) {
            return true;
        }

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


    private function getType() {
        $array = DB::table($this->table)
                ->select('tourType_id')
                ->where('tour_id', $this->id)
                ->get();

        return $array[0]->tourType_id;
    }

}
