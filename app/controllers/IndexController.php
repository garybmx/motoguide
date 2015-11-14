<?php

class IndexController extends BaseController {
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


    public function index() {
        $infoModel = new Information(Config::get('app.locale'));
        $information = $infoModel->getInformation();

        $timerModel = new Timer();
        $timerArray = $timerModel->getTimer("fullCheck");
        if (!empty($timerArray)) {
            $timerArray['countdown'] = $this->getTime($timerArray['date'], $timerArray['time']);
        }

        
        $factoryTour = new TourFactory();
        $futureTourArray['timer'] = $timerModel->getTimer('getTour');
        if (!empty($futureTourArray['timer'])) {
            $futureTourModel = $factoryTour->getTour('FutureTour', Config::get('app.locale'), $futureTourArray['timer']['tour_id']);
            $futureTourArray = $futureTourModel->setUpShortTourInfo();
            $futureTourArray['description'] = mb_substr($futureTourArray['description'], 0, 120, 'UTF-8') . '...';
        } else {
            $futureTourArray = array();
        }
        
        $pastTourModel = $factoryTour->getAllTours('PastTour', Config::get('app.locale'));
        $pastTourArray = $pastTourModel->setUpAllToursInfo(array('tour_id', 'name', 'startTime'), 'activeOnly');

        $clientModel = new Client(Config::get('app.locale'));
        $clientArray = $clientModel->setUpRandomClient();

       

        return View::make('index', array('information' => $information,
        'timerArray' => $timerArray,
        'futureTourArray' => $futureTourArray,
        'pastTourArray' => $pastTourArray,
        'clientArray' => $clientArray
        ));
    }


    private function getTime($date, $time) {
        $returnString = $date . ',' . $time;
        $returnString = str_replace(array('-', ':'), ',', $returnString);
        $returnArray = explode(',', $returnString);

        return $returnArray;
    }

}
