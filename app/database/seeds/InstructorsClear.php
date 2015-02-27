<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstructorsClear
 *
 * @author Manager
 */
class InstructorsClear extends Seeder {
    public function run() {
        DB::table('instructors_en')->truncate();
        DB::table('instructors_ru')->truncate();
    }
}
