<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Manager
 */
class AdminContactsController extends \BaseController {

    private $rules = array(
        'ru_address' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\ \.\,\;\.:\(\)\/]+$)u'),
        'ru_mail' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\@\ \;\.:\(\)\/]+$)u'),
        'ru_phone' => array('Regex:(^[A-Za-z0-9\n\r\\-\,\ \;\.:\(\)\/]+$)u'),
        'en_address' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\.\,\ \;\.:\(\)\/]+$)u'),
        'en_mail' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\@\ \;\.:\(\)\/]+$)u'),
        'en_phone' => array('Regex:(^[A-Za-z0-9\n\r\-\,\ \;\.:\(\)\/]+$)u'),
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.'
    );
    private $imageHeight = 640;
    private $imageWidth = 480;


    public function index() {
        $contactRu = new Contact('ru');
        $contactEn = new Contact('en');

        $contactArray = $contactRu->getContact();
        $contactArrayEng = $contactEn->getContact();

        return View::make('admin.contacts', array('contactArray' => $contactArray, 'contactArrayEng' => $contactArrayEng));
    }


    public function update() {
        $messages = new Illuminate\Support\MessageBag;

        if (Input::has('photo')) {
            $this->insertImage(Input::file('motoPhoto'));

            return Redirect::back();
        }

        if (Input::has('deleteImage')) {
            
            $this->deleteImage();
            return Redirect::back();
        }
       
        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        $messages->add('active', Input::get('lang'));

        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput();
        }

        $contactInfo = array(
            'contact_id' => 1,
            'address' => Input::get(Input::get('lang') . '_address'),
            'mail' => Input::get(Input::get('lang') . '_mail'),
            'phone' => Input::get(Input::get('lang') . '_phone'),
        );


        $contact = new Contact(Input::get('lang'));
        $check = $contact->editContact($contactInfo);



        if ($check == true) {
            $messages->add('done', 'Запись обновлена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Запись не обновлена');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function insertImage($image) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $path = base_path() . '\public\images\contacts\map.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\contacts', 'map.jpeg');

        $height = Image::make($path)->height();
        $width = Image::make($path)->width();

        if ($height != $this->imageHeight || $width != $this->imageWidth) {
            $img = Image::make($path)->resize($this->imageHeight, $this->imageWidth);
        } else {
            $img = Image::make($path);
        }
        $check = $img->save();

        if (is_object($check)) {
            $doneMessages->add('done', 'Файл загружен');
            return Redirect::back()->withErrors($doneMessages);
        } else {
            $doneMessages->add('notdone', 'Файл не загружен');
            return Redirect::back()->withErrors($doneMessages);
        }
    }


    private function deleteImage() {

        $path = base_path() . '\public\images\contacts\map.jpeg';
        File::delete($path);

        return Redirect::back();
    }

}
