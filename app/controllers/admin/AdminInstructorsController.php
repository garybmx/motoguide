<?php

class AdminInstructorsController extends \BaseController {

    private $rules = array(
        'ru_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_active' => 'boolean',
        'ru_lastname' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'ru_age' => 'integer',
        'ru_expirience' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)\s]+$/u'),
        'en_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_active' => 'boolean',
        'en_lastname' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'en_age' => 'integer',
        'en_expirience' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)\s]+$/u')
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
        $instructors = new Instructor('ru');
        $instructorsEng = new Instructor('en');
        $allInstructors = $instructors->setUpAllInstructorsInfo();
        $allInstructorsEng = $instructorsEng->setUpAllInstructorsInfo();
        $check = $this->checkAndInsertRecords($allInstructors, $allInstructorsEng);

        if ($check == true) {
            return Redirect::to('/admin/instructors');
        }

        return View::make('admin.instructors', array('allInstructors' => $allInstructors,
                    'allInstructorsEng' => $allInstructorsEng));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin.instructorCreate');
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

        $instructorInfo = array(
            'id' => null,
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'lastname' => Input::get(Input::get('lang') . '_lastname'),
            'age' => Input::get(Input::get('lang') . '_age'),
            'expirience' => Input::get(Input::get('lang') . '_expirience')
        );

        $instructor = new Instructor('ru');
        $messages = new Illuminate\Support\MessageBag;

        $check = $instructor->insertInstructorInfo($instructorInfo);


        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.instructors.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.instructors.index')->withErrors($messages);
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
        $instructor = new Instructor('ru', $id);
        $instructorEng = new Instructor('en', $id);
        $instructorArray = $instructor->setUpInstructorInfo();
        $instructorArrayEng = $instructorEng->setUpInstructorInfo();

        return View::make('admin.instructorShow', array('instructorArray' => $instructorArray,
                    'instructorArrayEng' => $instructorArrayEng));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $instructor = new Instructor('ru', $id);
        $instructorEng = new Instructor('en', $id);
        $instructorArray = $instructor->setUpInstructorInfo();
        $instructorArrayEng = $instructorEng->setUpInstructorInfo();


        return View::make('admin.instructorEdit', array('instructorArray' => $instructorArray,
                    'instructorArrayEng' => $instructorArrayEng));
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

        $instructorInfo = array(
            'id' => $id,
            'name' => Input::get(Input::get('lang') . '_name'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'lastname' => Input::get(Input::get('lang') . '_lastname'),
            'age' => Input::get(Input::get('lang') . '_age'),
            'expirience' => Input::get(Input::get('lang') . '_expirience')
        );

        $instructor = new Instructor(Input::get('lang'), $id);
      

        $check = $instructor->updateInstructorInfo($instructorInfo);



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

        
        $path = base_path() . '\public\images\instructors\instructor_' . $id . '.jpeg';
        if(file_exists($path)){
        File::delete($path);
        }
        
        $instructor = new Instructor('ru', $id);
        $messages = new Illuminate\Support\MessageBag;
        
        $check = $instructor->deleteInstructorInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function checkAndInsertRecords($allInstructors, $allInstructorsEng) {
        $diffArraycheck1 = array_diff_key($allInstructors, $allInstructorsEng);
        $diffArraycheck2 = array_diff_key($allInstructorsEng, $allInstructors);

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

            $instructor = new Instructor('ru', $name['id']);
            $instructor->checkAndInsert();
        }
    }


    private function insertImage($image, $id) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $path = base_path() . '\public\images\instructors\instructor_' . $id . '.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\instructors', 'instructor_' . $id . '.jpeg');

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

        $path = base_path() . '\public\images\instructors\instructor_' . $id . '.jpeg';
        File::delete($path);

        return Redirect::back();
    }

}
