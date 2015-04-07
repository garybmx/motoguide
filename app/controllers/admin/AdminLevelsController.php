<?php

class AdminLevelsController extends \BaseController {

    private $rules = array(
        'ru_level_id' => 'integer',
        'en_level_id' => 'integer',
        'ru_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'ru_description' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)\s]+$/u'),
        'en_name' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\\ \.:\(\)]+$/u'),
        'en_description' => array('Regex:/^[A-Za-zа-яА-Я0-9\-! ,\.:\(\)\s]+$/u')
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.',
        'integer' => 'Запись не добавлена: Поле должно содержать только цифры'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $levels = new Level('ru');
        $levelsEng = new Level('en');
        $allLevels = $levels->setUpAllLevelsInfo();
        $allLevelsEng = $levelsEng->setUpAllLevelsInfo();
        $check = $this->checkAndInsertRecords($allLevels, $allLevelsEng);

        if ($check == true) {
            return Redirect::to('/admin/levels');
        }

        return View::make('admin.levels', array('allLevels' => $allLevels,
                    'allLevelsEng' => $allLevelsEng));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin.levelCreate');
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

        $levelInfo = array(
            'level_id' => null,
            'name' => Input::get(Input::get('lang') . '_name'),
            'description' => Input::get(Input::get('lang') . '_description')
        );

        $level = new Level('ru');
        $messages = new Illuminate\Support\MessageBag;

        $check = $level->insertLevelInfo($levelInfo);


        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.levels.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.levels.index')->withErrors($messages);
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
        $level = new Level('ru', $id);
        $levelEng = new Level('en', $id);
        $levelArray = $level->setUpLevelInfo();
        $levelArrayEng = $levelEng->setUpLevelInfo();

        return View::make('admin.levelShow', array('levelArray' => $levelArray,
                    'levelArrayEng' => $levelArrayEng));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $level = new Level('ru', $id);
        $levelEng = new Level('en', $id);
        $levelArray = $level->setUpLevelInfo();
        $levelArrayEng = $levelEng->setUpLevelInfo();


        return View::make('admin.levelEdit', array('levelArray' => $levelArray,
                    'levelArrayEng' => $levelArrayEng));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $messages = new Illuminate\Support\MessageBag;

       

       

        $validator = Validator::make(Input::all(), $this->rules, $this->messages);

        $messages->add('active', Input::get('lang'));

        if ($validator->fails()) {

            $messages->merge($validator);
            return Redirect::back()->withErrors($messages)->withInput();
        }

        $levelInfo = array(
            'level_id' => $id,
            'name' => Input::get(Input::get('lang') . '_name'),         
            'description' => Input::get(Input::get('lang') . '_description')
        );

        $level = new Level(Input::get('lang'), $id);


        $check = $level->updateLevelInfo($levelInfo);



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


       

        $level = new Level('ru', $id);
        $messages = new Illuminate\Support\MessageBag;

        $check = $level->deleteLevelInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }

    private function checkAndInsertRecords($allLevels, $allLevelsEng) {
        $diffArraycheck1 = array_diff_key($allLevels, $allLevelsEng);
        $diffArraycheck2 = array_diff_key($allLevelsEng, $allLevels);

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

    private function insertAbsentRecords($array) {
        foreach ($array as $name) {

            $level = new Level('ru', $name['level_id']);
            $level->checkAndInsert();
        }
    }

}
