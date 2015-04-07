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



Route::group(array('prefix' => 'admin'), function()
{
    Route::get('/', 'AdminController@index');
    
    Route::resource('motorcycles', 'AdminMotorcyclesController');
    Route::resource('instructors', 'AdminInstructorsController');
    Route::resource('PastTour', 'AdminToursController');
    Route::resource('FutureTour', 'AdminToursController');
    Route::resource('levels', 'AdminLevelsController');
    
});


Route::get('/', function()
{
	return View::make('hello');
});


Route::get('/users', function()
{
    return View::make('example');
});