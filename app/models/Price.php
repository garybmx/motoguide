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


    function setId($id) {
        $this->id = $id;
    }


    public function getAllPrices() {
        return DB::table($this->table)
                        ->select('name as price_name', 'price', 'price_id')
                        ->where('tour_id', $this->id)
                        ->get();
    }


    public function insertPrices($priceArray = array()) {
        if (empty($priceArray))
            return true;

        $check = array();

        foreach ($priceArray as $priceName) {
            $check[] = DB::table($this->table)->insert(
                    array('tour_id' => $this->id,
                        'name' => $priceName['name'],
                        'price' => $priceName['price']
            ));

            return $this->checkTrue($check);
        }
    }


    public function updatePrices($priceArray = array()) {
        if (empty($priceArray))
            return;

        $check = array();

        foreach ($priceArray as $priceName) {
            $exist = DB::table($this->table)
                    ->where('price_id', $priceName['price_id'])
                    ->count();

            if ($exist > 0) {
                $numeric = DB::table($this->table)->where('price_id', $priceName['price_id'])->update(
                        array(
                            'name' => $priceName['name'],
                            'price' => $priceName['price']
                ));

                if ($numeric > 0) {
                    $check[] = true;
                } else {
                    $check[] = false;
                }
            } else {
                $check[] = DB::table($this->table)->insert(
                        array(
                            'tour_id' => $this->id,
                            'name' => $priceName['name'],
                            'price' => $priceName['price']
                ));
            }
        }

        return $this->checkTrue($check);
    }


    public function deletePriceRecords() {
        $exist = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->count();

        if ($exist == 0)
            return true;

        $check = DB::table($this->table)
                ->where('tour_id', $this->id)
                ->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteOnePriceRecord($priceId) {
        $check = DB::table($this->table)
                ->where('id', $priceId)
                ->delete();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    private function checkTrue($check = array()) {
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

}
