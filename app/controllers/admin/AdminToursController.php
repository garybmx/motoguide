<?php

class AdminToursController extends \BaseController {

    private $rules = array(
        'ru_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_startTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'ru_endTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'ru_description' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \.:\(\)\/]+$)um'),
        'ru_duration' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\ \.:\(\)]+$/u'),
        'ru_level_id' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_location' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_review' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \.:\(\)\/]+$)um'),
        'en_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_startTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'en_endTime' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'en_description' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \.:\(\)\/]+$)um'),
        'en_duration' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_level_id' => array('Regex:/^[A-Za-zа-яА-Я0-9\<\>\-! ,\\ \.:\(\)]+$/u'),
        'en_location' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_review' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\-!\,\\\ \.:\(\)\/]+$)um'),
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.',
        'boolean' => 'Запись не добавлена: Недопустимые сиволы.',
        'integer' => 'Запись не добавлена: Поле должно содержать только цифры'
    );
    private $imageHeight = 300;
    private $imageWidth = 200;


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
//        $check = $this->checkAndInsertRecords($allTours, $allToursEng);
        //   if ($check == true) {
        //return Redirect::to('/admin/tours');
        //     }

        return View::make('admin.tours.' . Request::segment(2), array('allTours' => $allTours,
                    'allToursEng' => $allToursEng));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin.tours.' . Request::segment(2) . 'Create');
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
            'review' => Input::get(Input::get('lang') . '_review'),
        );

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

        return View::make('admin.tours.' . Request::segment(2) . 'Show', array('tourArray' => $tourArray,
                    'tourArrayEng' => $tourArrayEng));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $factoryTour = new TourFactory();

        $tours = $factoryTour->getTour(Request::segment(2), 'ru', $id);
        $toursEng = $factoryTour->getTour(Request::segment(2), 'en', $id);
        $tourArray = $tours->setUpTourInfo();
        $tourArrayEng = $toursEng->setUpTourInfo();
        $tourArray = $this->checkDate($tourArray);
        $tourArrayEng = $this->checkDate($tourArrayEng);
       

        return View::make('admin.tours.' . Request::segment(2) . 'Edit', array('tourArray' => $tourArray,
                    'tourArrayEng' => $tourArrayEng));
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

        $tourInfo = array(
            'tour_id' => Input::get(Input::get('tour_id')),
            'tourType_id' => '2',
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'startTime' => Input::get(Input::get('lang') . '_startTime'),
            'endTime' => Input::get(Input::get('lang') . '_endTime'),
            'description' => Input::get(Input::get('lang') . '_description'),
            'duration' => Input::get(Input::get('lang') . '_duration'),
            'level_id' => Input::get(Input::get('lang') . '_level_id'),
            'location' => Input::get(Input::get('lang') . '_location'),
            'review' => Input::get(Input::get('lang') . '_review'),
        );

        $factoryTour = new TourFactory();
        $tours = $factoryTour->addTour(Request::segment(2), Input::get('lang'), Input::get('tour_id'));
       
        $check = $tours->updateTour($tourInfo);



       
            $messages->add('done', 'Запись обновлена');
            return Redirect::back()->withErrors($messages);
      
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {


        $path = base_path() . '\public\images\tours\tour_' . $id . '.jpeg';
        if (file_exists($path)) {
            File::delete($path);
        }

        $tour = new TourFactory('ru', $id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $tour->deleteTourInfo();

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

            $tour = new TourFactory('ru', $name['id']);
            $tour->checkAndInsert();
        }
    }


    private function insertImage($image, $id) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $path = base_path() . '\public\images\tours\tour_' . $id . '.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\tours', 'tour_' . $id . '.jpeg');

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


    private function deleteImage($id) {

        $path = base_path() . '\public\images\tours\tour_' . $id . '.jpeg';
        File::delete($path);

        return Redirect::back();
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

}
