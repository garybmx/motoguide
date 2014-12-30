<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Price
 *
 * @author Manager
 */
class Price {

    protected $table;
    protected $language;
    private $id;

    function __construct($language, $id) {
        $this->language = $language;
        $this->id = $id;
        $this->table = 'prices_' . $this->language;
    }

    public function getAllPrices() {
        return DB::select('select `name` as "price_name", `price`, `price_id` from ' . $this->table . ' where `tour_id`="' . $this->id . '"');
    }

}
