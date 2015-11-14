<?php

class AuthController extends \BaseController {


    public function getLogin() {
        return View::make('admin.login');
    }


    public function postLogin() {
        $rules = array(
            'username' => 'required|alpha_dash',
            'password' => 'required|min:8|alpha_dash',);

        $messages = array('required' => 'поле не заполнено',
            'min:8' => 'минимум 8 символов',
            'alpha_dash' => 'Недопустимые символы'
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            return Redirect::intended('admin');
        } else {
            App::abort('404');
        }
    }


    public function getLogout() {
        Auth::logout('WithoutRemember');
        return Redirect::to('/');
    }

}
