<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PastTour
 *
 * @author Manager
 */
class PastTour extends Tour {

    private $condition;

    function __construct($language) {
        parent::__construct($language);
        $this->condition = new ConditionPast($this->language);
    }

}
