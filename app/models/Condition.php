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
        $this->condition = DB::table($this->table, 'levels_'. $this->language)
                        ->select('duration',  'location', 'levels_'.
                                $this->language . '.description as level' )
                        ->where('tour_id', $this->id)
                        ->leftJoin('levels_' . $this->language, 
                                $this->table . '.level_id', '=', 'levels_' .
                                $this->language . '.level_id')
                        ->get();
                var_dump($this->condition);
        return $this->condition;
    }

}
