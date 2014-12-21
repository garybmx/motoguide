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
class Tour extends Illuminate\Database\Eloquent {

 
    /**
     * @var int $id        Should contain a description 
     */
 

    protected $table;
    protected $primaryKey = 'tour_id';
    protected $timestamps = false;
    /**
     * @return int Return id of the tour
     */
  
    function __construct($language) {
        $this->language = $language;
        $this->table = 'tours_' . $this->language;
    }

}
