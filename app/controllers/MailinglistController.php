<?php

class MailinglistController extends BaseController {

    private $rules = array(
        'mailinglist' => 'required|email'
    );
    private $messagesRu = array(
        'mailinglist.required' => 'Необходимо указать email',
        'mailinglist.email' => 'Неверный формат электронного адреса',
    );
    private $messagesEn = array(
        'mailinglist.required' => 'You have to specify your email address',
        'mailinglist.email' => 'Incorrect email format',
    );


    public function update() {
        if (Input::has('newslang')) {
            Config::set('app.locale', Input::get('newslang'));
        }
        $mailinglistModel = new Mailinglist;
        $messages = new Illuminate\Support\MessageBag;

        $data = array(
            'mailinglist' => Input::get('mailinglist'),
            'newslang' => Input::get('newslang')
        );

        if (Input::get('newslang') == 'ru') {
            $message = $this->messagesRu;
        } else {
            $message = $this->messagesEn;
        }
        Session::flash('session', 'true');

        $validator = Validator::make($data, $this->rules, $message);
        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput();
        }

        $dataFordatabase = array('email' => $data['mailinglist']);
        if ($data['newslang'] == 'ru') {
            $dataFordatabase['lang'] = 1;
        } else {
            $dataFordatabase['lang'] = 0;
        }



        $check = $mailinglistModel->insertMailinglistInfo($dataFordatabase);


        if ($check == true) {
            $messages->add('letterdone', 'Ваша заявка принята! Мы обязательно свяжемся с Вами в ближайшее время.');
        } else {
            $messages->add('letternotdone', 'Не удалось отправить заявку. Пожалуйста, свяжитесь с нами по электронной почте или телефону.');
        }

        return Redirect::back()->with('errors', $messages);
    }

}
