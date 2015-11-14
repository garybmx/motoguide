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



Route::group(array('prefix' => 'admin', 'before'=> 'auth'), function() {
    Route::get('/', 'AdminSettingsController@index');
    Route::get('timer', 'AdminTimerController@index');
    Route::put('timer', 'AdminTimerController@update');
    Route::get('contacts', 'AdminContactsController@index');
    Route::put('contacts', 'AdminContactsController@update');
    Route::get('information', 'AdminInformationController@index');
    Route::put('information', 'AdminInformationController@update');
    Route::get('settings', 'AdminSettingsController@index');
    Route::put('settings', 'AdminSettingsController@update');

    Route::get('logout', 'AuthController@getLogout');


    Route::resource('blog', 'AdminBlogController');
    Route::resource('mailinglist', 'AdminMailinglistController');
    Route::resource('request', 'AdminRequestController', array('except' => array('create', 'store')));
    Route::resource('motorcycles', 'AdminMotorcyclesController');
    Route::resource('instructors', 'AdminInstructorsController');
    Route::resource('clients', 'AdminClientsController');
    Route::resource('levels', 'AdminLevelsController');

    if (Request::segment(2) == "PastTour") {
        Route::resource('PastTour', 'AdminToursController');
    } elseif (Request::segment(2) == "FutureTour") {
        Route::resource('FutureTour', 'AdminToursController');
    }
});

Route::get('admin/login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    

Route::group(array('prefix' => '{lang?}', 'before' => 'detectLang:' . Request::segment(1) . '|loadContacts'), function() {

    Route::group(array('before' => 'cache', 'after' => 'cache'), function() {
        Route::get('/', 'IndexController@index');
        Route::get('futureTours/{id}', 'FutureToursController@showTour')->where('id', '[0-9]+');
        Route::get('pastTours/{id}', 'PastToursController@showTour')->where('id', '[0-9]+');
        Route::get('motorcycles', 'MotorcyclesController@index');
        Route::get('instructors', 'InstructorsController@index');
        Route::get('blog/{id}', 'BlogController@showBlog')->where('id', '[0-9]+');
        Route::get('contacts', 'ContactsController@index');
    });
    Route::get('futureTours', 'FutureToursController@index');
    Route::get('pastTours', 'PastToursController@index');
    Route::get('blog', 'BlogController@index');
    Route::get('request', 'RequestController@index');
});
Route::post('request', 'RequestController@update');
Route::post('mailinglist', 'MailinglistController@update');
/*


  

 
    Route::get('/', 'IndexController@index');
    Route::get('futureTours', 'FutureToursController@index');
    Route::get('pastTours', 'PastToursController@index');
    Route::get('motorcycles', 'MotorcyclesController@index');
    Route::get('instructors', 'InstructorsController@index');
    Route::get('request', 'RequestController@index');
    Route::get('blog', 'BlogController@index');
    Route::get('contacts', 'ContactsController@index');
    
});*/



