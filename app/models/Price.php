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
                        ->select('name as price_name', 'price', 'price_id', 'description')
                        ->where('tour_id', $this->id)
                        ->get();
    }


    public function insertPrices($priceArray = array()) {
        if (empty($priceArray))
            return true;

        $check = array();


        foreach ($priceArray as $priceName) {

            if (array_key_exists('delete', $priceName)) {
                $this->deleteOnePriceRecord($priceName['price_id']);
            } else {

                $check[] = DB::insert(
                                'insert into `' . $this->table . '` (`price_id`, `tour_id`, `name`, `price`, `description`) values (?, ?, ?, ?, ?)
             on duplicate key update `name`=values(`name`), `price`=values(`price`), `tour_id`=values(`tour_id`), `description`=values(`description`)', array($priceName['price_id'], $this->id, $priceName['name'], $priceName['price'], $priceName['description'])
                );
                $this->checkAndInsert($priceName['price_id']);
            }

            $checkId = DB::select('select last_insert_id() as id ');
            $this->checkAndInsert($checkId[0]->id);
        }


        return $this->checkTrue($check);
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

        $exist = DB::table($this->table)
                ->where('price_id', $priceId)
                ->count();
        if ($exist != 0) {
            $check = DB::table($this->table)
                    ->where('price_id', $priceId)
                    ->delete();
        }


        $anotherLangPrice = addMultiLanguageService::getAnotherLanguageObj('Price', $this->language, $this->id);
        $check = $anotherLangPrice->deleteAnotherPriceRecord($priceId);

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteAnotherPriceRecord($priceId) {


        $exist = DB::table($this->table)
                ->where('price_id', $priceId)
                ->count();

        if ($exist != 0) {
            $check = DB::table($this->table)
                    ->where('price_id', $priceId)
                    ->delete();
        }


        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function addEmptyRecord($price_id) {
        $check = true;
        $cnt = DB::table($this->table)->where('price_id', $price_id)->where('tour_id', $this->id)->count();
        if ($cnt == 0) {
            $check = DB::insert('insert into `' . $this->table . '` (`price_id`, `tour_id`, `name`, `price`, `description`) values (?, ?, ?, ?, ?)
             on duplicate key update `name`=values(`name`), `price`=values(`price`), `tour_id`=values(`tour_id`), `description`=values(`description`)', array($price_id, $this->id, '', '', '')
            );
        }
        return $check;
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


    private function checkAndInsert($checkId) {
        if ($checkId == 0) {
            return true;
        }

        $anotherLangPrice = addMultiLanguageService::getAnotherLanguageObj('Price', $this->language, $this->id);
        $check = $anotherLangPrice->addEmptyRecord($checkId);

        return $check;
    }

}
