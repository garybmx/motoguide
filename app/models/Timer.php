<?php

class Timer {

    private $id = 1;
    private $timerTable = 'timer';
    private $timerInfo = array('id' => 1,
        'tour_id' => '',
        'active' => '0',
        'date' => '',
        'time' => '09:00:00');


    public function createTimer() {

        $cnt = DB::table($this->timerTable)->where('id', $this->id)->count();
        if ($cnt == 0) {
            $this->insertContact();
        }
    }


    public function getTimer($fullCheck = null) {
        $returnArray = array();
        $cnt = DB::table($this->timerTable)->where('id', $this->id)->count();
        if ($cnt == 0) {
            $this->createTimer();
        }
        $object = DB::table($this->timerTable)
                ->where('id', $this->id)
                ->get();

        foreach ($object as $value) {
            foreach ($value as $name => $val) {
                $returnArray[$name] = $val;
            }
        }
        
        if($fullCheck == 'getTour'){
            $returnArray = $this->checkTour($returnArray);
            return $returnArray;
            
        }
        
        $returnArray = $this->checkDate($returnArray);
                     
        if ($fullCheck != null) {
            $returnArray = $this->checkActive($returnArray);
            $returnArray = $this->checkTour($returnArray);
        }

        return $returnArray;
    }

    
    

    private function insertContact() {

        return DB::table($this->timerTable)->insert(
                        array('id' => $this->id,
                            'tour_id' => '0',
                            'active' => '0',
                            'date' => '',
                            'time' => ''
        ));
    }


    public function editTimer($insertArray) {

        $arrayCheck = $this->arrayCheck($insertArray, $this->timerInfo);

        if (empty($insertArray) || $arrayCheck === false) {
            return false;
        }


        $check = DB::table($this->timerTable)
                ->where('id', $this->id)
                ->update(array(
            'tour_id' => $insertArray['tour_id'],
            'active' => $insertArray['active'],
            'date' => $insertArray['date'],
            'time' => $insertArray['time'])
        );

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }


    protected function arrayCheck($checkArray, $defaultArray) {

        $returnArray = array_diff_key($checkArray, $defaultArray);

        if (empty($returnArray)) {
            return true;
        } else {
            return false;
        }
    }


    private function checkDate($array) {
        if ($array['date'] == '0000-00-00') {
            $array['date'] = '';
        }
        if ($array['time'] == '00:00:00') {
            $array['time'] = '9';
        }
        return $array;
    }

    /* Проверяем активен ли таймер
     * 
     */


    private function checkActive($array) {
        if ($array['active'] == 1) {
            return $array;
        } else {
            return array();
        }
    }

    /* Проверяем есть ли тур, предстоящий ли это тур, активен ли тур
     * 
     */


    private function checkTour($array) {
        try {
            $factoryTour = new TourFactory();
            $futureTourModel = $factoryTour->getTour('FutureTour', Config::get('app.locale'), $array['tour_id']);
            $tourArray = $futureTourModel->setUpTourInfo();
        } catch (Exception $e) {
            return array();
        }
        if ($tourArray['tourType_id'] != 1 || $tourArray['active'] != 1) {
            return array();
        }
        return $array;
    }

}
