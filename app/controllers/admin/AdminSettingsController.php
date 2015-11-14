<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Manager
 */
class AdminSettingsController extends \BaseController {


    public function index() {

        $mailinglistModel = new Mailinglist;
        $mailinglist = count($mailinglistModel->setUpAllMailinglistsInfo());

        $requestModel = new RequestTour;
        $requestAll = $requestModel->setUpAllRequestsInfo();
        $request = count($requestAll);
        $requestNew = 0;
        foreach($requestAll as $rq){
            if($rq['new'] == 1){
                $requestNew++;
            }
        }

        //Cache::flush();
        return View::make('admin.settings', array('mailinglist' => $mailinglist, 'request' => $request, 'requestNew' => $requestNew));
    }


    public function update() {
        $messages = new Illuminate\Support\MessageBag;
        Cache::flush();
        $messages->add('done', 'Кэш обновлен');
        return Redirect::back()->withErrors($messages);
    }

}
