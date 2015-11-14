<?php

class PastToursController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    private $monthArray = array(
        'ru' => array(
            0 => '---',
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ),
        'en' => array(
            0 => '---',
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'December',
        ),
    );


    public function index() {

        $factoryTour = new TourFactory();
        $tours = $factoryTour->getAllTours('PastTour', Config::get('app.locale'));
        $toursArray = $tours->setUpPaginateInfo();




        return View::make('pastTours', array('toursArray' => $toursArray));
    }


    public function showTour($lang, $id) {

        $factoryTour = new TourFactory();
        $tours = $factoryTour->getTour('PastTour', Config::get('app.locale'), $id);
        $tourArray = $tours->setUpTourInfo('ActiveOnly');

        $futureTours = $factoryTour->getAllTours('FutureTour', Config::get('app.locale'));
        $futureArray = $futureTours->setUpAllToursInfo(array(), 'ActiveOnly');

        if ($tourArray['nodateactive'] == 0) {
            $tourArray['start_date'] = explode('-', $tourArray['startTime']);
            $tourArray['start_day'] = $tourArray['start_date'][2];
            $tourArray['start_year'] = $tourArray['start_date'][0];
            $tourArray['start_month'] = $this->monthArray[Config::get('app.locale')][(int) $tourArray['start_date'][1]];
            $tourArray['end_date'] = explode('-', $tourArray['endTime']);
            $tourArray['end_day'] = $tourArray['end_date'][2];
            $tourArray['end_year'] = $tourArray['end_date'][0];
            $tourArray['end_month'] = $this->monthArray[Config::get('app.locale')][(int) $tourArray['end_date'][1]];
        }



        $fileArray = $this->getFileArray($id);

        $clientModel = new Client(Config::get('app.locale'));
        $clientArray = $clientModel->setUpRandomClient();

        return View::make('pastTourItem', array('tourArray' => $tourArray,
                    'fileArray' => $fileArray,
                    'clientArray' => $clientArray,
            'futureArray'=> $futureArray));
    }


    private function getFileArray($id) {
        $fileArray = array();
        $path = base_path() . '\public\images\tours\tour_' . $id;
        if (!is_dir($path)) {
            return $fileArray;
        }
        $list = scandir($path);
        foreach ($list as $item) {
            if ($item != "." && $item != ".." && !(strpos($item, '.jpeg') === false)) {
                $fileArray[] = $item;
            }
        }
        sort($fileArray, SORT_STRING);
        return $fileArray;
    }

}
