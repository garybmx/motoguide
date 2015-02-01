<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addMultiLanguageService
 *
 * @author Manager
 */
class addMultiLanguageService {


    public static function getAnotherLanguageObj($className, $language) {
        return new $className(addMultiLanguageService::detectLanguage($language));
    }


    public static function detectLanguage($language) {
        if ($language == 'en') {
            return 'ru';
        } elseif ($language == 'ru') {
            return 'en';
        }
    }

}