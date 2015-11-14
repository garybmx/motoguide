<?php

/*
  |--------------------------------------------------------------------------
  | Application & Route Filters
  |--------------------------------------------------------------------------
  |
  | Below you will find the "before" and "after" events for the application
  | which may be used to do any work before or after a request into your
  | application. Here you may also register your custom route filters.
  |
 */

App::before(function($request) {
    //
});


App::after(function($request, $response) {
    //
});

/*
  |--------------------------------------------------------------------------
  | Authentication Filters
  |--------------------------------------------------------------------------
  |
  | The following filters are used to verify that the user of the current
  | session is logged into this application. The "basic" filter easily
  | integrates HTTP Basic authentication for quick, simple checking.
  |
 */

Route::filter('auth', function() {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        }
        return Redirect::guest('admin/login');
    }
});


Route::filter('auth.basic', function() {
    return Auth::basic();
});

/*
  |--------------------------------------------------------------------------
  | Guest Filter
  |--------------------------------------------------------------------------
  |
  | The "guest" filter is the counterpart of the authentication filters as
  | it simply checks that the current user is not logged in. A redirect
  | response will be issued if they are, which you may freely change.
  |
 */

Route::filter('guest', function() {
    if (Auth::check())
        return Redirect::to('/');
});

/*
  |--------------------------------------------------------------------------
  | CSRF Protection Filter
  |--------------------------------------------------------------------------
  |
  | The CSRF filter is responsible for protecting your application against
  | cross-site request forgery attacks. If this special token in a user
  | session does not match the one given in this request, we'll bail.
  |
 */

Route::filter('csrf', function() {
    if (Session::token() !== Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

//Route::filter('localization', function() {
//    App::setLocale(Route::input('lang'));
//});

Route::filter('detectLang', function($route, $request, $lang = null) {

    
    if ($lang != null && in_array($lang, Config::get('app.available_language'))) {
        //0if($lang != Config::get('app.locale')){
        //return Redirect::back();
        //}
        Config::set('app.locale', $lang);
    } elseif ($lang == null || !in_array($lang, Config::get('app.available_language'))) {
        
        $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
        $browser_lang = substr($browser_lang, 0, 2);
        $userLang = (in_array($browser_lang, Config::get('app.available_language'))) ? $browser_lang : Config::get('app.locale');
        Config::set('app.locale', $userLang);
        return Redirect::to(Config::get('app.locale'). '/'. $lang);
    }
});

Route::filter('cache', function($route, $request, $response = null) {
    $key = 'route-' . Str::slug(Request::url());
    if (is_null($response) && Cache::has($key) && !Session::has('session')) {
   
        return Cache::get($key);
    } elseif (!is_null($response) && !Cache::has($key)) {
        Cache::put($key, $response->getContent(), 1440);
    }
});

Route::filter('loadContacts', function() {
    $contactModel = new Contact(Config::get('app.locale'));
    $contactArray = $contactModel->getContact();
    View::share('contactArray', $contactArray);
});
