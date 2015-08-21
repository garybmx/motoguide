<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminRequestController
 *
 * @author Manager
 */
class AdminRequestController extends \BaseController {

    private $rules = array(
        'name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'lastname' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'location' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'age' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'comments' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'phone' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.\+:\(\)]+$/u'),
        'email' => array('Regex:/^[A-Za-zа-яА-Я0-9\-!@ ,\\ \.:\(\)]+$/u'),
        'date' => array('Regex:/^[0-9]{1,4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}/'),
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.',
        'boolean' => 'Запись не добавлена: Недопустимые сиволы.',
        'integer' => 'Запись не добавлена: Поле должно содержать только цифры'
    );


    public function index() {

        $request = new RequestTour();
        $allRequests = $request->setUpAllRequestsInfo();

        return View::make('admin.request', array('allRequests' => $allRequests));
    }


    public function show($id) {
        $request = new RequestTour($id);
        $request->setStatus();
        $requestArray = $request->setUpRequestInfo();


        return View::make('admin.requestShow', array('requestArray' => $requestArray));
    }


    public function edit($id) {
        $request = new RequestTour($id);
        $requestArray = $request->setUpRequestInfo();


        return View::make('admin.requestEdit', array('requestArray' => $requestArray));
    }


    public function update($id) {


        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $requestInfo = array(
            'id' => null,
            'name' => Input::get('name'),
            'lastname' => Input::get('lastname'),
            'location' => Input::get('location'),
            'age' => Input::get('age'),
            'comments' => Input::get('comments'),
            'phone' => Input::get('phone'),
            'email' => Input::get('email'),
            'new' => 0,
            'date' => Input::get('date')
        );

        $request = new RequestTour($id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $request->updateRequestInfo($requestInfo);


        if ($check == true) {
            $messages->add('done', 'Запись обновлена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Запись не обновлена');
            return Redirect::back()->withErrors($messages);
        }

        //
    }


    public function destroy($id) {
        $request = new RequestTour($id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $request->deleteRequestInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }

}
