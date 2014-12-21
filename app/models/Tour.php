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
    public $primaryKey = 'tour_id';
    public $timestamps = false;

    /**
     * @return int Return id of the tour
     */
    function __construct($language) {
        $this->language = $language;
        $this->table = 'tours_' . $this->language;
    }

    function getTourInfo($id) {
        return DB::select('select * from ' . $this->table .' where `tour_id`=' . $id);
    }

    function setTourInfo() {
        DB::insert('insert into ' . $this->table . ' (id, name) values (?, ?)', array(1, 'Dayle'));
    }

}
