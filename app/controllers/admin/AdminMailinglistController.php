<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminMailinglistController
 *
 * @author Manager
 */
class AdminMailinglistController extends \BaseController {

    private $allLang = array('0' => 'en',
        '1' => 'ru');
    private $rules = array(
        'email' => array('Regex:/^[A-Za-zа-яА-Я0-9\@! ,\\ \.:\(\)]+$/u'),
        'lang' => array('Regex:/^[0-9\-! ,\.:\(\)]+$/u'),
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.'
    );


    public function index() {

        $mailinglist = new Mailinglist();
        $allMailinglists = $mailinglist->setUpAllMailinglistsInfo();

        return View::make('admin.mailinglist', array('allMailinglists' => $allMailinglists));
    }


    public function create() {

        return View::make('admin.mailinglistCreate', array('allLang' => $this->allLang));
    }


    public function store() {


        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $mailinglistInfo = array(
            'id' => null,
            'email' => Input::get('email'),
            'lang' => Input::get('lang')
        );

        $model = new Mailinglist();
        $messages = new Illuminate\Support\MessageBag;

        $check = $model->insertMailinglistInfo($mailinglistInfo);


        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.mailinglist.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.mailinglist.index')->withErrors($messages);
        }

        //
    }


    public function edit($id) {
        $mailinglist = new Mailinglist($id);
        $mailinglistArray = $mailinglist->setUpInfo();
        

        return View::make('admin.mailinglistEdit', array('mailinglistArray' => $mailinglistArray, 'allLang' => $this->allLang));
    }


    public function update($id) {


        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $mailinglistInfo = array(
            'id' => null,
            'email' => Input::get('email'),
            'lang' => Input::get('lang')
        );

        $mailinglist = new Mailinglist($id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $mailinglist->updateMailinglistInfo($mailinglistInfo);


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
        $mailinglist = new Mailinglist($id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $mailinglist->deleteMailinglistInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }


    public function show($lang) {
        $mailinglist = new Mailinglist();

        $mailinglistString = $mailinglist->setUpMailinglistInfo($lang);

        return View::make('admin.mailinglistShow', array('mailinglistString' => $mailinglistString));
    }

}
