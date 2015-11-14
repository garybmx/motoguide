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
    protected $ConditionTable;
    protected $levelTable;
    protected $language;
    protected $allToursInfo = array();
    protected $tourType;
    protected $langId;
    protected $paginator;


    /**
     * @return int Return id of the tour
     */
    function __construct($language) {
        $this->language = $language;
        $this->table = 'tours_' . $this->language;
        $this->ConditionTable = 'condition_' . $this->language;
        $this->levelTable = 'levels_' . $this->language;
        $this->paginator = 2;
    }


    public function setLangId($langId) {
        $this->langId = $langId;
    }


    public function setUpPaginateInfo() {

        $returnArray = array();

        $tourInfo = $this->getPaginate();

        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {

                $this->allToursInfo[$value->tour_id][$name] = $val;
            }
        }

        $returnArray['items'] = $this->allToursInfo;
        $returnArray['links'] = $tourInfo->links("layouts.paginator");

        return $returnArray;
    }


    public function setUpAllToursInfo($select = array(), $isactive = null, $num = null) {

        $tourInfo = $this->getAllTour($select, $isactive, $num);

        foreach ($tourInfo as $value) {
            foreach ($value as $name => $val) {

                $this->allToursInfo[$value->tour_id][$name] = $val;
            }
        }

        return $this->allToursInfo;
    }


    function getFullTourInfo($id, $select = array(), $isactive = null) {
        $activestring = '';
        $returnArray = array();
        if($isactive != null){
            $activestring = ' AND `active` = 1';
        }
        $returnArray = DB::select('select * from ' . $this->table . ' where `tour_id`=' . $id . $activestring);
        if (empty($returnArray)) {
            App::abort(404);
        }
        return $returnArray;
    }


    function getAllTour($select = array(), $isactive = null, $num = null, $paginate = null) {
        $isactiveString = '';
        $limit = '';
        if ($isactive != null) {
            $isactiveString = ' AND `active` = 1';
        }



        if ($num != null) {
            $limit = ' LIMIT ' . $num;
        }


        if (empty($select)) {
            return DB::select('select * from ' . $this->table . ' where `tourType_id`=' . $this->tourType . $isactiveString . ' ORDER BY `tour_id` DESC ' . $limit);
        } else {

            $selectString = "`" . implode("`,`", $select) . "`";
            return DB::select('select ' . $selectString . ' from ' . $this->table . ' where `tourType_id`=' . $this->tourType . $isactiveString . ' ORDER BY `tour_id` DESC ' . $limit);
        }
    }


    protected function getPaginate() {


        return DB::table($this->table)
                        ->join($this->ConditionTable, $this->table . '.tour_id', '=', $this->ConditionTable . '.tour_id')
                        ->leftJoin($this->levelTable, $this->ConditionTable . '.level_id', '=', $this->levelTable . '.level_id')
                        ->select($this->table . '.*', $this->ConditionTable . '.*', $this->levelTable . '.name as level')
                        ->where($this->table . '.tourType_id', $this->tourType)
                        ->where($this->table . '.active', 1)
                        ->orderBy($this->table . '.tour_id', 'desc')
                        ->paginate($this->paginator);
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
                    'nodateactive' => $tourArray['nodateactive'],
                    'nodate' => $tourArray['nodate'],
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
            'nodateactive' => $tourArray['nodateactive'],
            'nodate' => $tourArray['nodate'],
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
