<?php

class AdminBlogController extends \BaseController {

    private $rules = array(
        'ru_header' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'ru_tags' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'ru_text' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'ru_date' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'ru_active' => 'boolean',
        'en_header' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_tags' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_text' => array('Regex:(^[A-Za-zа-яА-Я0-9\n\r\<\>\&\?\-!\,\\\ \;\.:\(\)\/]+$)u'),
        'en_date' => array('Regex:/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}$/'),
        'en_active' => 'boolean',
        
    );
    private $messages = array(
        'regex' => 'Запись не добавлена: Недопустимые сиволы.',
        'boolean' => 'Запись не добавлена: Недопустимые сиволы.',
        'integer' => 'Запись не добавлена: Поле должно содержать только цифры'
    );
    private $imageHeight = 580;
    private $imageWidth = 870;


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $blog = new Blog('ru');
        $blogEng = new Blog('en');
        $allBlogs = $blog->setUpAllBlogInfo();
        $allBlogsEng = $blogEng->setUpAllBlogInfo();
        $check = $this->checkAndInsertRecords($allBlogs, $allBlogsEng);

        if ($check == true) {
            return Redirect::to('/admin/blog');
        }

        return View::make('admin.blog', array('allBlog' => $allBlogs,
                    'allBlogEng' => $allBlogsEng));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('admin.blogCreate');
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

        $blogInfo = array(
            'id' => null,
            'header' => Input::get(Input::get('lang') . '_header'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'text' => Input::get(Input::get('lang') . '_text'),
            'tags' => Input::get(Input::get('lang') . '_tags'),
            'date' => Input::get(Input::get('lang') . '_date')            
        );

      
        $blog = new Blog('ru');
        $messages = new Illuminate\Support\MessageBag;

        $check = $blog->insertBlogInfo($blogInfo);


        if ($check == true) {
            $messages->add('done', 'Запись добавлена');
            return Redirect::route('admin.blog.index')->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось добавить запись');
            return Redirect::route('admin.blog.index')->withErrors($messages);
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
        $blog = new Blog('ru', $id);
        $blogEng = new Blog('en', $id);
        $blogArray = $blog->setUpBlogInfo();
        $blogArrayEng = $blogEng->setUpBlogInfo();

        return View::make('admin.blogShow', array('blogArray' => $blogArray,
                    'blogArrayEng' => $blogArrayEng));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $blog = new Blog('ru', $id);
        $blogEng = new Blog('en', $id);
        $blogArray = $blog->setUpBlogInfo();
        $blogArrayEng = $blogEng->setUpBlogInfo();

         $blogArray = $this->checkDate($blogArray);
         $blogArrayEng = $this->checkDate($blogArrayEng);

        return View::make('admin.blogEdit', array('blogArray' => $blogArray,
                    'blogArrayEng' => $blogArrayEng));
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

        $blogInfo = array(
            'id' => $id,
            'header' => Input::get(Input::get('lang') . '_header'),
            'active' => (Input::get(Input::get('lang') . '_active') == '') ? 0 : 1,
            'text' => Input::get(Input::get('lang') . '_text'),
            'tags' => Input::get(Input::get('lang') . '_tags'),
            'date' => Input::get(Input::get('lang') . '_date')       
        );

        $blog = new Blog(Input::get('lang'), $id);
      

        $check = $blog->updateBlogInfo($blogInfo);



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

        
        $path = base_path() . '\public\images\blog\blog_' . $id . '.jpeg';
        if(file_exists($path)){
        File::delete($path);
        }
        
        $blog = new Blog('ru', $id);
        $messages = new Illuminate\Support\MessageBag;
        
        $check = $blog->deleteBlogInfo();

        if ($check == true) {
            $messages->add('done', 'Запись удалена');
            return Redirect::back()->withErrors($messages);
        } else {
            $messages->add('notdone', 'Не удалось удалить запись');
            return Redirect::back()->withErrors($messages);
        }
    }


    private function checkAndInsertRecords($allBlogs, $allBlogsEng) {
        $diffArraycheck1 = array_diff_key($allBlogs, $allBlogsEng);
        $diffArraycheck2 = array_diff_key($allBlogsEng, $allBlogs);

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

            $blog = new Blog('ru', $name['id']);
            $blog->checkAndInsert();
        }
    }


    private function insertImage($image, $id) {
        $doneMessages = new Illuminate\Support\MessageBag;
        $file = array('image' => $image);
        $path = base_path() . '\public\images\Blog\blog_' . $id . '.jpeg';
        $rules = array('image' => 'required|mimes:jpeg,jpg',
        );
        $messages = array('required' => 'Ошибка: файл не выбран',
            'mimes' => 'Файл не загружен! Разрешенные типы файлов: .jpeg или .jpg'
        );

        $validator = Validator::make($file, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::back()->withErrors($validator);
        }

        $image->move(base_path() . '\public\images\blog', 'blog_' . $id . '.jpeg');

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

        $path = base_path() . '\public\images\blog\blog_' . $id . '.jpeg';
        File::delete($path);

        return Redirect::back();
    }

      private function checkDate($array) {
        if ($array['date'] == '0000-00-00') {
            $array['date'] = '';
        }
        return $array;
    }
}
