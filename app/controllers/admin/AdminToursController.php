<?php

class AdminToursController extends \BaseController {

    private $rules = array(
        'ru_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_startTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'ru_endTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'ru_description' => array('Regex:(^[A-Za-zа-яА-Я0-9\<\>\&\-!\,\\\ \;\.:\(\)\/\n\r]+$)u'),
        'ru_duration' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\ \.:\(\)]+$/u'),
        'ru_level_id' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_location' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_review' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'ru_feed' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'ru_residence' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_startTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'en_endTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'en_description' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_duration' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_level_id' => array('Regex:/^[A-Za-zа-яА-Я0-9\<\>\-! ,\\ \.:\(\)]+$/u'),
        'en_location' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_review' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_feed' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_residence' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \;\.:\(\)\/]+$)u'),
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.',
        'boolean' => 'Запись не добавлена: Недопустимые сиволы.',
        'integer' => 'Запись не добавлена: Поле должно содержать только цифры'
    );
    private $imageHeight = 480;
    private $imageWidth = 640;


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $factoryTour = new TourFactory();

        $tours = $factoryTour->getAllTours(Request::segment(2), 'ru');
        $toursEng = $factoryTour->getAllTours(Request::segment(2), 'en');
        $allTours = $tours->setUpAllToursInfo();
        $allToursEng = $toursEng->setUpAllToursInfo();

        $check = $this->checkAndInsertRecords($allTours, $allToursEng);
        if ($check == true) {
            return Redirect::to('/admin/' . Request::segment(2));
        }

        return View::make('admin.tours.' . Request::segment(2), array('allTours' => $allTours,
                    'allToursEng' => $allToursEng));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $level = new Level('ru');
        $allLevels = $level->setUpListLevelsInfo();
        if (empty($allLevels)) {
            return Redirect::to('/admin/levels/create');
        }
        return View::make('admin.tours.' . Request::segment(2) . 'Create', array('allLevels' => $allLevels));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {


        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator)->withInput(Input::except(array('ru_startTime', 'ru_endTime')));
        }


        $tourInfo = array(
            'tour_id' => null,
            'tourType_id' => Input::get('tourType_id'),
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'startTime' => Input::get(Input::get('lang') . '_startTime'),
            'endTime' => Input::get(Input::get('lang') . '_endTime'),
            'description' => Input::get(Input::get('lang') . '_description'),
            'duration' => Input::get(Input::get('lang') . '_duration'),
            'level_id' => Input::get(Input::get('lang') . '_level_id'),
            'location' => Input::get(Input::get('lang') . '_location'),
        );

        if (Input::get('tourType_id') == '1') {

            $tourInfo['residence'] = Input::get(Input::get('lang') . '_residence');
            $tourInfo['feed'] = Input::get(Input::get('lang') . '_feed');
        } elseif (Input::get('tourType_id') == '2') {
            $tourInfo['review'] = Input::get(Input::get('lang') . '_review');
        }



        $factoryTour = new TourFactory();
        $tours = $factoryTour->addTour(Request::segment(2), 'ru', null);


        $messages = new Illuminate\Support\MessageBag;


        $check = $tours->addTour($tourInfo);

        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.' . Request::segment(2) . '.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.' . Request::segment(2) . '.index')->withErrors($messages);
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
        $factoryTour = new TourFactory();

        $tours = $factoryTour->getTour(Request::segment(2), 'ru', $id);
        $toursEng = $factoryTour->getTour(Request::segment(2), 'en', $id);
        $tourArray = $tours->setUpTourInfo();
        $tourArrayEng = $toursEng->setUpTourInfo();
        $fileArray = $this->getFileArray($id);
         
        return View::make('admin.tours.' . Request::segment(2) . 'Show', array('tourArray' => $tourArray,
                    'tourArrayEng' => $tourArrayEng, 'fileArray' => $fileArray));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $factoryTour = new TourFactory();
        $level = new Level('ru');
        $levelEng = new Level('en');
        $allLevels = $level->setUpListLevelsInfo();
        $allLevelsEng = $levelEng->setUpListLevelsInfo();
        $allLevels[0] = 'не выбран';
        $allLevelsEng[0] = 'not selected';


        $tours = $factoryTour->getTour(Request::segment(2), 'ru', $id);
        $toursEng = $factoryTour->getTour(Request::segment(2), 'en', $id);
        $tourArray = $tours->setUpTourInfo();
        $tourArrayEng = $toursEng->setUpTourInfo();
        $tourArray = $this->checkDate($tourArray);
        $tourArrayEng = $this->checkDate($tourArrayEng);
        $fileArray = $this->getFileArray($id);

        $prices = $this->getPrices($id, 'ru');
        $pricesEng = $this->getPrices($id, 'en');



        return View::make('admin.tours.' . Request::segment(2) . 'Edit', array('tourArray' => $tourArray,
                    'tourArrayEng' => $tourArrayEng, 'fileArray' => $fileArray, 'allLevels' => $allLevels, 'allLevelsEng' => $allLevelsEng, 'prices' => $prices, 'pricesEng' => $pricesEng));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $messages = new Illuminate\Support\MessageBag;


        if (Input::has('price_ok')) {
            $message = $this->savePrice(Input::all(), $id);

            if (!empty($message->get('error'))) {

                return Redirect::back()->withErrors($message)->withInput(Input::except('lang'));
            }
            return Redirect::to('/admin/' . Request::segment(2) . '/' . $id . '/edit')->withErrors($message);
        }

        if (Input::has('photo')) {
            $this->insertImage(Input::file('motoPhoto'), $id, Input::get('editImage'));

            return Redirect::back();
        }

        if (Input::has('deleteImage')) {
            $this->deleteImage($id, Input::get('deleteImageName'));
            return Redirect::back();
        }

        if (Input::has('change')) {
            $this->changeType($id);
            $messages->add('done', 'Тур перенесен в прошедшие');
            return Redirect::to('/admin/' . Request::segment(2))->withErrors($messages);
            ;
        }

        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        $messages->add('active', Input::get('lang'));

        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput(Input::except('lang'));
        }


        $tourInfo = array(
            'tour_id' => Input::get('tour_id'),
            'tourType_id' => Input::get('tourType_id'),
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'startTime' => Input::get(Input::get('lang') . '_startTime'),
            'endTime' => Input::get(Input::get('lang') . '_endTime'),
            'description' => Input::get(Input::get('lang') . '_description'),
            'duration' => Input::get(Input::get('lang') . '_duration'),
            'level_id' => Input::get(Input::get('lang') . '_level_id'),
            'location' => Input::get(Input::get('lang') . '_location'),
        );

        if (Input::get('tourType_id') == '1') {

            $tourInfo['residence'] = Input::get(Input::get('lang') . '_residence');
            $tourInfo['feed'] = Input::get(Input::get('lang') . '_feed');
        } elseif (Input::get('tourType_id') == '2') {
            $tourInfo['review'] = Input::get(Input::get('lang') . '_review');
        }



        $factoryTour = new TourFactory();
        $tours = $factoryTour->addTour(Request::segment(2), Input::get('lang'), Input::get('tour_id'));

        $check = $tours->updateTour($tourInfo);

        if ($check == true) {
            $messages->add('done', 'Запись обновлена');
        } else {
            $messages->add('notdone', 'Запись не обновлена');
        }
        return Redirect::to('/admin/' . Request::segment(2) . '/' . $id . '/edit')->withErrors($messages);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {


        $path = base_path() . '\public\images\tours\tour_' . $id;
        if (is_dir($path)) {
            File::deleteDirectory($path);
        }

        $factoryTour = new TourFactory('ru', $id);
        $tour = $factoryTour->addTour(Request::segment(2), 'ru', $id);

        $messages = new Illuminate\Support\MessageBag;

        $check = $tour->deleteTour();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function checkAndInsertRecords($allTours, $allToursEng) {
        $diffArraycheck1 = array_diff_key($allTours, $allToursEng);
        $diffArraycheck2 = array_diff_key($allToursEng, $allTours);

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

            $factoryTour = new TourFactory();
            $tour = $factoryTour->addTour(Request::segment(2), 'ru', $name['tour_id']);

            $tour->checkAndInsert();
        }
    }


    private function insertImage($image, $id, $editImage) {

        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $fileNumber = $this->getFileNumber($id);
        if ($editImage != '') {
            $fileName = $editImage;
        } else {
            $fileName = 'enduroTour' . $fileNumber . '.jpeg';
        }
        $path = base_path() . '\public\images\tours\tour_' . $id . '\\' . $fileName;
        $paththumbs = base_path() . '\public\images\tours\tour_' . $id . '\thumbs\\' . $fileName;
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }


        $image->move(base_path() . '\public\images\tours\tour_' . $id, $fileName);

        if (!is_dir(base_path() . '\public\images\tours\tour_' . $id . '\thumbs')) {
            mkdir(base_path() . '\public\images\tours\tour_' . $id . '\thumbs');
        }
        copy($path, $paththumbs);

        $height = Image::make($path)->height();
        $width = Image::make($path)->width();

        if ($height != $this->imageHeight || $width != $this->imageWidth) {
            $img = Image::make($path)->resize($this->imageWidth, $this->imageHeight);
        } else {
            $img = Image::make($path);
        }
        $imgthumbs = Image::make($paththumbs)->resize(100, 100);
        $imgthumbs->save();

        $check = $img->save();

        if (is_object($check)) {
            $doneMessages->add('done', 'Файл загружен');
            return Redirect::back()->withErrors($doneMessages);
        } else {
            $doneMessages->add('notdone', 'Файл не загружен');
            return Redirect::back()->withErrors($doneMessages);
        }
    }


    private function deleteImage($id, $name) {

        $path = base_path() . '\public\images\tours\tour_' . $id . '\\' . $name;
        $paththumbs = base_path() . '\public\images\tours\tour_' . $id . '\thumbs\\' . $name;

        File::delete($path);
        File::delete($paththumbs);

        return Redirect::back();
    }


    private function getFileNumber($id) {
        $fileArray = array();
        $path = base_path() . '\public\images\tours\tour_' . $id;
        if (!is_dir($path)) {
            return 1;
        }
        $list = scandir($path);
        foreach ($list as $item) {
            if ($item != "." && $item != ".." && !(strpos($item, '.jpeg') === false)) {
                $item = substr_replace($item, '', 0, strlen('enduroTour'));
                $fileArray[] = substr_replace($item, '', -5, strlen('.jpeg'));
            }
        }
        sort($fileArray, SORT_NUMERIC);
        $newNumber = array_pop($fileArray);
        $newNumber++;
        return $newNumber;
    }


    private function getFileArray($id) {
        $fileArray = array();
        $path = base_path() . '\public\images\tours\tour_' . $id;
        if (!is_dir($path)) {
            return $fileArray;
        }
        $list = scandir($path);
        foreach ($list as $item) {
            if ($item != "." && $item != ".." && !(strpos($item, '.jpeg') === false)) {
                $fileArray[] = $item;
            }
        }
        sort($fileArray, SORT_STRING);
        return $fileArray;
    }


    private function checkDate($array) {
        if ($array['startTime'] == '0000-00-00') {
            $array['startTime'] = '';
        }
        if ($array['endTime'] == '0000-00-00') {
            $array['endTime'] = '';
        }
        return $array;
    }


    private function getPrices($id, $lang) {


        $price = new Price($lang, $id);
        $getPrice = $price->getAllPrices();

        if (!empty($getPrice)) {
            $i = 1;
            foreach ($getPrice as $prices) {
                $priceArray[$i]['num'] = $i;
                $priceArray[$i]['name'] = $prices->price_name;
                $priceArray[$i]['price_id'] = $prices->price_id;
                $priceArray[$i]['price'] = $prices->price;
                $priceArray[$i]['description'] = $prices->description;
                $i++;
            }
        } else {
            $priceArray[1]['num'] = 1;
            $priceArray[1]['name'] = '';
            $priceArray[1]['price'] = '';
            $priceArray[1]['price_id'] = '';
            $priceArray[1]['description'] = '';
        }
        return $priceArray;
    }


    private function savePrice($input, $id) {

        $messages = new Illuminate\Support\MessageBag;
        $rules = array();
        $priceArray = array();
        for ($i = 1; $i <= $input['num']; $i++) {
            $priceArray[$i]['price_id'] = $input[$input['lang'] . '_price_id_' . $i];
            $priceArray[$i]['name'] = $input[$input['lang'] . '_price_name_' . $i];
            $priceArray[$i]['price'] = $input[$input['lang'] . '_price_price_' . $i];
            $priceArray[$i]['description'] = $input[$input['lang'] . '_price_description_' . $i];

            $rules[$input['lang'] . '_price_name_' . $i] = array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u');
            $rules[$input['lang'] . '_price_price_' . $i] = array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u');
            $rules[$input['lang'] . '_price_description_' . $i] = array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \.:\(\)\/]+$)u');

            if (array_key_exists($input['lang'] . '_delete_' . $i, $input)) {
                $priceArray[$i]['delete'] = $input[$input['lang'] . '_delete_' . $i];
            }
        }


        $validator = Validator::make(Input::all(), $rules, $this->messages);

        $messages->add('active1', Input::get('lang'));

        if ($validator->fails()) {


            $messages->add('error', 'Цены не сохранены: Недопустимые символы в полях!');
            return $messages;
            //Redirect::back()->withErrors($messages)->withInput();
        }

        $price = new Price($input['lang'], $input['tour_id']);
        $price->insertPrices($priceArray);

        return $messages;
    }


    private function changeType($id) {
        
        $factoryTour = new TourFactory('ru', $id);
        $tour = $factoryTour->addTour(Request::segment(2), 'ru', $id);
        $check = $tour->changeType();
    }

}
