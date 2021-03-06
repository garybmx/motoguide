<?php

class AdminClientsController extends \BaseController {

    private $rules = array(
        'ru_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_active' => 'boolean',
        'ru_tour_id' => 'integer',
        'ru_review' => array('Regex:(^[A-Za-zа-яА-Я0-9\<\>\&\?\-!\,\\\ \\"\=;\.:\(\)\/\n\r]+$)u'),
        'en_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_active' => 'boolean',
        'en_tour_id' => 'integer',
        'en_review' => array('Regex:(^[A-Za-zа-яА-Я0-9\<\>\&\?\-!\,\\\ \\"\=;\.:\(\)\/\n\r]+$)u')
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.',
        'boolean' => 'Запись не добавлена: Недопустимые сиволы.',
        'integer' => 'Запись не добавлена: Поле должно содержать только цифры'
    );
    private $imageWidth = 150;
    private $imageHeight = 150;
    


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $clients = new Client('ru');
        $clientsEng = new Client('en');
        $allClients = $clients->setUpAllClientsInfo();
        $allClientsEng = $clientsEng->setUpAllClientsInfo();
        $check = $this->checkAndInsertRecords($allClients, $allClientsEng);

        if ($check == true) {
            return Redirect::to('/admin/clients');
        }

        return View::make('admin.clients', array('allClients' => $allClients,
                    'allClientsEng' => $allClientsEng));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $level = new Level('ru');
        $tours = new PastTour('ru');
        $select = array("tour_id", "name");
        $pastTours = $tours->setUpListToursInfo($select);
        return View::make('admin.clientCreate', array('pastTours' => $pastTours));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {


        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->withInput();
        }

        $clientInfo = array(
            'id' => null,
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'tour_id' => Input::get(Input::get('lang') . '_tour_id'),
            'review' => Input::get(Input::get('lang') . '_review'),
        );

        $client = new Client('ru');
        $messages = new Illuminate\Support\MessageBag;

        $check = $client->insertClientInfo($clientInfo);


        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.clients.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.clients.index')->withErrors($messages);
        }

        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $client = new Client('ru', $id);
        $clientEng = new Client('en', $id);

        $clientArray = $client->setUpClientInfo();
        $clientArrayEng = $clientEng->setUpClientInfo();
        $tour_id = $client->getClientTourId();
        $tours = new PastTour('ru', $tour_id);
        $tourInfo = $tours->setUpTourInfo();
       
        
        return View::make('admin.clientShow', array('clientArray' => $clientArray,
                    'clientArrayEng' => $clientArrayEng, 'tour_name' => $tourInfo['name']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $client = new Client('ru', $id);
        $clientEng = new Client('en', $id);
        $clientArray = $client->setUpClientInfo();
        $clientArrayEng = $clientEng->setUpClientInfo();
        $tour_id = $client->getClientTourId();
       
        $tours = new PastTour('ru');
        $select = array("tour_id", "name");
        $pastTours = $tours->setUpListToursInfo($select);
        

        return View::make('admin.clientEdit', array('clientArray' => $clientArray,
                    'clientArrayEng' => $clientArrayEng, 'pastTours' => $pastTours, 'tour_id' => $tour_id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $messages = new Illuminate\Support\MessageBag;

        if (Input::has('photo')) {
            $this->insertImage(Input::file('motoPhoto'), $id);

            return Redirect::back();
        }

        if (Input::has('deleteImage')) {
            $this->deleteImage($id);
            return Redirect::back();
        }

        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        $messages->add('active', Input::get('lang'));

        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput();
        }

       $clientInfo = array(
            'id' => null,
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'tour_id' => Input::get(Input::get('lang') . '_tour_id'),
            'review' => Input::get(Input::get('lang') . '_review'),
        );

        $client = new Client(Input::get('lang'), $id);


        $check = $client->updateClientInfo($clientInfo);



        if ($check == true) {
            $messages->add('done', 'Запись обновлена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Запись не обновлена');
            return Redirect::back()->withErrors($messages);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {


        $path = base_path() . '\public\images\clients\client_' . $id . '.jpeg';
        if (file_exists($path)) {
            File::delete($path);
        }

        $client = new Client('ru', $id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $client->deleteClientInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function checkAndInsertRecords($allClients, $allClientsEng) {
        $diffArraycheck1 = array_diff_key($allClients, $allClientsEng);
        $diffArraycheck2 = array_diff_key($allClientsEng, $allClients);

        if (!empty($diffArraycheck1)) {
            $this->insertAbsentRecords($diffArraycheck1);
            return true;
        }
        if (!empty($diffArraycheck2)) {
            $this->insertAbsentRecords($diffArraycheck2);
            return true;
        }
        return FALSE;
    }


    private function getLangErrors($lang, $validator) {
        $mes = new Illuminate\Support\MessageBag;
        $mes->merge($validator);
        $errors = $mes->toArray();
        $returnArray = array();
        foreach ($errors as $name => $value) {
            $returnArray[$lang . '_' . $name] = $errors[$name][0];
        }
        return $returnArray;
    }


    private function insertAbsentRecords($array) {
        foreach ($array as $name) {

            $client = new Client('ru', $name['id']);
            $client->checkAndInsert();
        }
    }


    private function insertImage($image, $id) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $path = base_path() . '\public\images\clients\client_' . $id . '.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\clients', 'client_' . $id . '.jpeg');

        $height = Image::make($path)->height();
        $width = Image::make($path)->width();

        if ($height != $this->imageHeight || $width != $this->imageWidth) {
            $img = Image::make($path)->resize($this->imageWidth, $this->imageHeight);
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


    private function deleteImage($id) {

        $path = base_path() . '\public\images\clients\client_' . $id . '.jpeg';
        File::delete($path);

        return Redirect::back();
    }

}
