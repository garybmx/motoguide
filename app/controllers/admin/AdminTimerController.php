<?php

class AdminTimerController extends \BaseController {
     
    
    private $timeArray = array('01:00:00' => '01:00:00',
        '02:00:00' => '02:00:00',
        '03:00:00' => '03:00:00',
        '04:00:00' => '04:00:00',
        '05:00:00' => '05:00:00',
        '06:00:00' => '06:00:00',
        '07:00:00' => '07:00:00',
        '08:00:00' => '08:00:00',
        '09:00:00' => '09:00:00',
        '10:00:00' => '10:00:00',
        '11:00:00' => '11:00:00',
        '12:00:00' => '12:00:00',
        '13:00:00' => '13:00:00',
        '14:00:00' => '14:00:00',
        '15:00:00' => '15:00:00',
        '16:00:00' => '16:00:00',
        '17:00:00' => '17:00:00',
        '18:00:00' => '18:00:00',
        '19:00:00' => '19:00:00',
        '20:00:00' => '20:00:00',
        '21:00:00' => '21:00:00',
        '22:00:00' => '22:00:00',
        '23:00:00' => '23:00:00',
        '24:00:00' => '24:00:00',
        
        );
    
    public function index() {
         
//   $contactRu = new Contact('ru');
      $tour = new FutureTour('ru');
      $timer = new Timer();
      $toursArray = $this->makeTourArray($tour->setUpAllToursInfo(array('tour_id', 'name')));
      $timerArray = $timer->getTimer();
      
      //    $contactArray = $contactRu->getContact();
    //    $contactArrayEng = $contactEn->getContact();

        return View::make('admin.timer',  array('timeArray' => $this->timeArray, 'toursArray' => $toursArray, 'timerArray' => $timerArray));
    }

     public function update() {
        $messages = new Illuminate\Support\MessageBag;

    
        $timeInfo = array(
            'id' => 1,
            'tour_id' => Input::get(Input::get('lang') . '_tour_id'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'date' => Input::get(Input::get('lang') . '_date'),
            'time' => Input::get(Input::get('lang') . '_time'),
            
        );

      
        $timer = new Timer();
        $check = $timer->editTimer($timeInfo);



        if ($check == true) {
            $messages->add('done', 'Запись обновлена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Запись не обновлена');
            return Redirect::back()->withErrors($messages);
        }
    }



    private function makeTourArray($toursArray){
        $returnArray = array('0' => 'Не определен');
        foreach ($toursArray as $name=>$val){
            $returnArray[$val['tour_id']] = $val['name'];
        }
        
        return $returnArray;
    }
}

