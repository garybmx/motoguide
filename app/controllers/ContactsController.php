<?php

class ContactsController extends BaseController {
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
        $infoArray = $infoModel->getInformation();
        
        $contactModel = new Contact(Config::get('app.locale'));
    
        
        return View::make('contacts', array('infoArray' => $infoArray));
    }

}
