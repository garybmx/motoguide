<?php

class AdminMotorcyclesController extends \BaseController {

    private $rules = array(
        'ru_model' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_active' => 'boolean',
        'ru_power' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'ru_weight' => 'integer',
        'ru_description' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)\s]+$/u'),
        'en_model' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_active' => 'boolean',
        'en_power' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)]+$/u'),
        'en_weight' => 'integer',
        'en_description' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)\s]+$/u')
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
        $motorcycles = new Motorcycle('ru');
        $motorcyclesEng = new Motorcycle('en');
        $allMotorcycles = $motorcycles->setUpAllMotorcylesInfo();
        $allMotorcyclesEng = $motorcyclesEng->setUpAllMotorcylesInfo();
        $check = $this->checkAndInsertRecords($allMotorcycles, $allMotorcyclesEng);

        if ($check == true) {
            return Redirect::to('/admin/motorcycles');
        }

        return View::make('admin.motorcycles', array('allMotorcycles' => $allMotorcycles,
                    'allMotorcyclesEng' => $allMotorcyclesEng));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin.motorcycleCreate');
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

        $motorcycleInfo = array(
            'id' => null,
            'model' => Input::get(Input::get('lang') . '_model'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'power' => Input::get(Input::get('lang') . '_power'),
            'weight' => Input::get(Input::get('lang') . '_weight'),
            'description' => Input::get(Input::get('lang') . '_description')
        );

        $model = new Motorcycle('ru');
        $messages = new Illuminate\Support\MessageBag;

        $check = $model->insertMotorcycleInfo($motorcycleInfo);


        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.motorcycles.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.motorcycles.index')->withErrors($messages);
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
        $motorcycle = new Motorcycle('ru', $id);
        $motorcycleEng = new Motorcycle('en', $id);
        $motorcycleArray = $motorcycle->setUpMotorcycleInfo();
        $motorcycleArrayEng = $motorcycleEng->setUpMotorcycleInfo();

        return View::make('admin.motorcycleShow', array('motorcycleArray' => $motorcycleArray,
                    'motorcycleArrayEng' => $motorcycleArrayEng));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $motorcycle = new Motorcycle('ru', $id);
        $motorcycleEng = new Motorcycle('en', $id);
        $motorcycleArray = $motorcycle->setUpMotorcycleInfo();
        $motorcycleArrayEng = $motorcycleEng->setUpMotorcycleInfo();


        return View::make('admin.motorcycleEdit', array('motorcycleArray' => $motorcycleArray,
                    'motorcycleArrayEng' => $motorcycleArrayEng));
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

        $motorcycleInfo = array(
            'id' => $id,
            'model' => Input::get(Input::get('lang') . '_model'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'power' => Input::get(Input::get('lang') . '_power'),
            'weight' => Input::get(Input::get('lang') . '_weight'),
            'description' => Input::get(Input::get('lang') . '_description')
        );

        $model = new Motorcycle(Input::get('lang'), $id);
      

        $check = $model->updateMotorcycleInfo($motorcycleInfo);



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

        
        $path = base_path() . '\public\images\motorcycles\motorcycle_' . $id . '.jpeg';
        if(file_exists($path)){
        File::delete($path);
        }
        
        $motorcycle = new Motorcycle('ru', $id);
        $messages = new Illuminate\Support\MessageBag;
        
        $check = $motorcycle->deleteMotorcycleInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function checkAndInsertRecords($allMotorcycles, $allMotorcyclesEng) {
        $diffArraycheck1 = array_diff_key($allMotorcycles, $allMotorcyclesEng);
        $diffArraycheck2 = array_diff_key($allMotorcyclesEng, $allMotorcycles);

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

            $motorcycle = new Motorcycle('ru', $name['id']);
            $motorcycle->checkAndInsert();
        }
    }


    private function insertImage($image, $id) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $path = base_path() . '\public\images\motorcycles\motorcycle_' . $id . '.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\motorcycles', 'motorcycle_' . $id . '.jpeg');

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

        $path = base_path() . '\public\images\motorcycles\motorcycle_' . $id . '.jpeg';
        File::delete($path);

        return Redirect::back();
    }

}
