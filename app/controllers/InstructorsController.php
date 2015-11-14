<?php

class InstructorsController extends BaseController {
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
        $instructorModel = new Instructor(Config::get('app.locale'));
        $instructorArray = $instructorModel->setUpAllInstructorsInfo('ActiveOnly');

        $infoModel = new Information(Config::get('app.locale'));
        $informationArray = $infoModel->getInformation();

        

        return View::make('instructors', array('instructorArray' => $instructorArray, 'informationArray' => $informationArray));
    }

}
