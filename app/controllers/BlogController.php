<?php

class BlogController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    private $monthArray = array(
        'ru' => array(
            0 => '---',
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ),
        'en' => array(
            0 => '---',
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'December',
        ),
    );


    public function index() {

        $blogObj = new Blog(Config::get('app.locale'));
        $blogArray = $blogObj->getPaginateBlog();


        foreach ($blogArray['items'] as $num => $blog) {
            $blogArray['items'][$num]['text'] = mb_substr($blog['text'], 0, 180, 'UTF-8') . '...';
            $blogArray['items'][$num]['date'] = explode('-', $blog['date']);
            $blogArray['items'][$num]['day'] = $blogArray['items'][$num]['date'][2];
            $blogArray['items'][$num]['year'] = $blogArray['items'][$num]['date'][0];
            $blogArray['items'][$num]['month'] = $this->monthArray[Config::get('app.locale')][(int) $blogArray['items'][$num]['date'][1]];
        }
        
       
        
        $factoryTour = new TourFactory();

        $futureTours = $factoryTour->getAllTours('FutureTour', Config::get('app.locale'));
        $futureArray = $futureTours->setUpAllToursInfo(array(), 'ActiveOnly', 4);

        $pastTours = $factoryTour->getAllTours('PastTour', Config::get('app.locale'));
        $pastArray = $pastTours->setUpAllToursInfo(array('tour_id', 'name', 'startTime'), 'ActiveOnly', 4);


        return View::make('blog', array('blogArray' => $blogArray, 'futureArray' => $futureArray, 'pastArray' => $pastArray));
    }


    public function showBlog($lang, $id) {

        $blogObj = new Blog(Config::get('app.locale'), $id);
        $blogArray = $blogObj->setUpBlogInfo('ActiveOnly');

        $blogArray['date'] = explode('-', $blogArray['date']);
        $blogArray['day'] = $blogArray['date'][2];
        $blogArray['year'] = $blogArray['date'][0];
        $blogArray['month'] = $this->monthArray[Config::get('app.locale')][(int) $blogArray['date'][1]];


        $factoryTour = new TourFactory();

        $futureTours = $factoryTour->getAllTours('FutureTour', Config::get('app.locale'));
        $futureArray = $futureTours->setUpAllToursInfo(array(), 'ActiveOnly', 4);

        $pastTours = $factoryTour->getAllTours('PastTour', Config::get('app.locale'));
        $pastArray = $pastTours->setUpAllToursInfo(array('tour_id', 'name', 'startTime'), 'ActiveOnly', 4);


        return View::make('blogItem', array('blogArray' => $blogArray, 'futureArray' => $futureArray, 'pastArray' => $pastArray));
    }

}
