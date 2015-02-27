<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Condition
 *
 * @author Manager
 */
class Condition {

    protected $language;
    protected $id;
    protected $condition;
    protected $table;


    function __construct($language, $id) {
        $this->id = $id;
        $this->language = $language;
        $this->table = 'condition_' . $this->language;
    }


    /**
     * 
     * @return array
     * Function return array of conditions
     */
    public function getCondition() {

        $this->condition = DB::table($this->table, 'levels_' . $this->language)
                ->select('duration', $this->table. '.level_id', 'location', 'levels_' .
                        $this->language . '.description as level')
                ->where('tour_id', $this->id)
                ->leftJoin('levels_' . $this->language, $this->table . '.level_id', '=', 'levels_' .
                        $this->language . '.level_id')
                ->get();

        return $this->condition;
    }


    public function insertConditionRecord($tourArray) {
        $this->checkAndDeleteId($this->table);

        return DB::table($this->table)->insert(
                        array('tour_id' => $this->id,
                            'duration' => $tourArray['duration'],
                            'level_id' => $tourArray['level_id'],
                            'location' => $tourArray['location'])
        );
    }


    public function updateConditionRecord($tourArray) {
        $exist = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0) {
            return $this->insertConditionRecord($tourArray);
        }
        
        $check = DB::table($this->table)->where('tour_id', $this->id)->update(
                array(
                    'duration' => $tourArray['duration'],
                    'level_id' => $tourArray['level_id'],
                    'location' => $tourArray['location'])
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteConditionRecord() {
        $exist = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0)
            return true;

        $check = $this->checkAndDeleteId($this->table);

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function checkAndDeleteId($table) {
        $cnt = DB::table($table)->where('tour_id', $this->id)->count();
        if ($cnt != 0) {
            return DB::table($table)->where('tour_id', $this->id)->delete();
        }
    }

}
