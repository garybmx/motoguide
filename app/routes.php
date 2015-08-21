<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */



Route::group(array('prefix' => 'admin'), function() {
    Route::get('/', 'AdminSettingsController@index');
    Route::get('timer', 'AdminTimerController@index');
    Route::put('timer', 'AdminTimerController@update');
    Route::get('contacts', 'AdminContactsController@index');
    Route::put('contacts', 'AdminContactsController@update');
    Route::get('information', 'AdminInformationController@index');
    Route::put('information', 'AdminInformationController@update');
    Route::get('settings', 'AdminSettingsController@index');
    Route::put('settings', 'AdminInformationController@update');
    
    Route::resource('request', 'AdminRequestController');
    Route::resource('motorcycles', 'AdminMotorcyclesController');
    Route::resource('instructors', 'AdminInstructorsController');
    Route::resource('clients', 'AdminClientsController');
    Route::resource('levels', 'AdminLevelsController');

    if (Request::segment(2) == "PastTour") {
        Route::resource('PastTour', 'AdminToursController');
    } elseif(Request::segment(2) == "FutureTour") {
        Route::resource('FutureTour', 'AdminToursController');
    }
});

Route::group(array('prefix' => '{lang?}', 'before' => 'detectLang:' . Request::segment(1). '|cache', 'after'=>'cache') , function() {
    
    Route::get('/', function() {
         
  
        return View::make('index');
    });
    
     Route::get('/pastTours/', function() {

        return View::make('pastTours');
    });
    
});

   
    


