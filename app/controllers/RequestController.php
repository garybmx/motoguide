<?php

class RequestController extends BaseController {

    private $rules = array(
        'name' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\ \.\,\;\.:\(\)\/]*$)u'),
        'phone' => array('Regex:(^[0-9\n\r\<\>\&\-!\ \\+.\,\;\.:\(\)\/]*$)u'),
        'email' => 'required|email',
        'comment' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\+\-\,\?\!\"\@\$\%\ \;\.:\(\)\/]*$)u'),
    );
    private $nl = array(
        'mailinglist' => 'required|email'
    );
    private $messagesRu = array(
        'email.required' => 'Необходимо указать email',
        'email.email' => 'Неверный формат электронного адреса',
        'mailinglist.required' => 'Необходимо указать email',
        'mailinglist.email' => 'Неверный формат электронного адреса',
        'regex' => 'Не отвпралено! Недопустимые сиволы в поле.'
    );
    private $messagesEn = array(
        'email.required' => 'You have to specify your email address',
        'email.email' => 'Incorrect email format',
        'mailinglist.required' => 'You have to specify your email address',
        'mailinglist.email' => 'Incorrect email format',
        'regex' => 'Your request has not been sent. Unacceptable symbols.'
    );
    private $selectTour = array();


    public function __construct() {
        if (Input::has('lang')) {
            Config::set('app.locale', Input::get('lang'));
        }

        $factoryTour = new TourFactory();
        $futureTourModel = $factoryTour->getAllTours('FutureTour', Config::get('app.locale'));
        $tourArray = $futureTourModel->setUpAllToursInfo(array('tour_id', 'name'), 'ActiveOnly');

        if (Config::get('app.locale') == 'ru') {
            $this->selectTour[0] = 'Не выбран';
        } else {
            $this->selectTour[0] = 'Not chosen';
        }

        if (!empty($tourArray)) {
            foreach ($tourArray as $tour) {
                $this->selectTour[$tour['tour_id']] = $tour['name'];
            }
        }
    }


    public function index() {
        $selected = 0;
        if (Request::has('request')) {
            $selected = Request::get('request');
        }
        return View::make('request', array('tourArray' => $this->selectTour, 'selected' => $selected));
    }


    public function update() {
        $requestModel = new RequestTour;
        $messages = new Illuminate\Support\MessageBag;


        if (Input::get('lang') == 'ru') {
            $message = $this->messagesRu;
        } else {
            $message = $this->messagesEn;
        }
        $validator = Validator::make(Input::all(), $this->rules, $message);

        $messages->add('active', Input::get('lang'));

        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput();
        }


        $data = array(
            'name' => Input::get('name'),
            'phone' => Input::get('phone'),
            'email' => Input::get('email'),
            'comment' => Input::get('comment'),
            'tour' => $this->selectTour[Input::get('tour')],
            'lang' => Input::get('lang')
        );


        Mail::send('emails.request', $data, function ($message) use ($data) {
            $message->subject('Заявка от: ' . $data['name'])
                    ->to('alex@lil.ru');
        });


        $check = $requestModel->insertRequestInfo($data);


        if ($check == true) {
            if (Config::get('app.locale') == 'ru') {
                $messages->add('done', 'Ваша заявка принята! Мы обязательно свяжемся с Вами в ближайшее время.');
            } else {
                $messages->add('done', 'Your request has been received! Our team contact you as soon as possible.');
            }
        } else {
            if (Config::get('app.locale') == 'ru') {
                $messages->add('notdone', 'Не удалось отправить заявку. Пожалуйста, свяжитесь с нами по электронной почте или телефону.');
            } else {
                $messages->add('notdone', 'Ooops! Something went wrong. Please contact us via email or phone.');
            }
        }


        return Redirect::to(Input::get('lang') . '/request')->with('errors', $messages);
    }


    public function milinglist() {
        if (Input::has('newslang')) {
            Config::set('app.locale', Input::get('newslang'));
        }
        $mailinglistModel = new Mailinglist;
        $messages = new Illuminate\Support\MessageBag;

        if (Input::get('newslang') == 'ru') {
            $message = $this->messagesRu;
        } else {
            $message = $this->messagesEn;
        }
        $validator = Validator::make(Input::all(), $this->nl, $message);

        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput();
        }


        $data = array(
            'mailinglist' => Input::get('mailinglist'),
            'lang' => Input::get('newslang')
        );



        $check = $mailinglistModel->insertMailinglistInfo($data);


        if ($check == true) {
            $messages->add('done', 'Ваша заявка принята! Мы обязательно свяжемся с Вами в ближайшее время.');
        } else {
            $messages->add('notdone', 'Не удалось отправить заявку. Пожалуйста, свяжитесь с нами по электронной почте или телефону.');
        }

        return Redirect::to(Input::get('lang') . '/request')->with('errors', $messages);
    }

}
