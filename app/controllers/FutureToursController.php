<?php

class FutureToursController extends BaseController {
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
        $factoryTour = new TourFactory();


        $futureTourModel = $factoryTour->getAllTours('FutureTour', Config::get('app.locale'));
        $futureTourArray = $futureTourModel->setUpPaginateInfo();
        foreach ($futureTourArray['items'] as $num => $tour) {

            $futureTourArray['items'][$num]['description'] = mb_substr($tour['description'], 0, 180, 'UTF-8') . '...';
        }


        return View::make('futureTours', array('futureTourArray' => $futureTourArray
        ));
    }


    public function showTour($lang, $id) {

        $factoryTour = new TourFactory();




        $tours = $factoryTour->getTour('FutureTour', Config::get('app.locale'), $id);
        $futureTours = $factoryTour->getAllTours('FutureTour', Config::get('app.locale'));
        
        $tourArray = $tours->setUpTourInfo('ActiveOnly');
        if(empty($tourArray)){
           App::abort(404);
        }
        $priceArray = $tours->getPrices($id);
        $fileArray = $this->getFileArray($id);
        
        $futureArray = $futureTours->setUpAllToursInfo(array(), 'ActiveOnly', 5);
       
        return View::make('tourItem', array('tourArray' => $tourArray, 
            'priceArray' => $priceArray, 
            'fileArray' => $fileArray,
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
