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
class AdminInformationController extends \BaseController {

    private $rules = array(
        'ru_value' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\;\.:\(\)\/]+$)u'),
        'en_value' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\ \;\.:\(\)\/]+$)u')
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.'
    );
    private $imageHeight = 640;
    private $imageWidth = 480;


    public function index() {

        $info = new Information('ru');
        $infoEng = new Information('en');

        $information = $info->getInformation();
        $informationEng = $infoEng->getInformation();

        return View::make('admin.information', array('informationArray' => $information, 'informationArrayEng' => $informationEng));
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

        if (Input::get('type') == 'banner' || Input::get('type') == 'info') {
            $informationInfo = array(
                'type' => Input::get('type'),
                'number' => Input::get('number'),
                'head' => Input::get(Input::get('lang') . '_head'),
                'text' => Input::get(Input::get('lang') . '_text')
            );

            $information = new Information(Input::get('lang'));
            $check = $information->editInformationTwo($informationInfo);
            
        } elseif (Input::get('type') == 'about' || Input::get('type') == 'video') {
            $informationInfo = array(
                'type' => Input::get('type'),
                'number' => Input::get('number'),
                'text' => Input::get(Input::get('lang') . '_text')
            );
            
            $information = new Information(Input::get('lang'));
            $check = $information->editInformationOne($informationInfo);
        }





        if ($check == true) {
            $messages->add('done_' . Input::get('type') . '_' . Input::get('number'), 'Запись обновлена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone_' . Input::get('type') . '_' . Input::get('number'), 'Запись не обновлена');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function insertImage($image) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);

        $path = base_path() . '\public\images\informations\\' . Input::get('type') . '_' . Input::get('number') . '.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\informations', Input::get('type') . '_' . Input::get('number') . '.jpeg');

        $height = Image::make($path)->height();
        $width = Image::make($path)->width();

        if ($height != $this->imageHeight || $width != $this->imageWidth) {
            $img = Image::make($path)->resize($this->imageHeight, $this->imageWidth);
        } else {
            $img = Image::make($path);
        }
        $check = $img->save();

        if (is_object($check)) {
            $doneMessages->add('done_' . Input::get('type') . '_' . Input::get('number'), 'Файл загружен');
            return Redirect::back()->withErrors($doneMessages);
        } else {
            $doneMessages->add('notdone_' . Input::get('type') . '_' . Input::get('number'), 'Файл не загружен');
            return Redirect::back()->withErrors($doneMessages);
        }
    }


    private function deleteImage() {

        $path = base_path() . '\public\images\informations\\' . Input::get('type') . '_' . Input::get('number') . '.jpeg';
        File::delete($path);

        return Redirect::back();
    }

}
