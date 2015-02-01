<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MotorcyclesClear
 *
 * @author Manager
 */
class MotorcyclesClear  extends Seeder {
    public function run() {
        DB::table('motorcycles_en')->truncate();
        DB::table('motorcycles_ru')->truncate();
    }
}
