<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TourFactory
 *
 * @author Manager
 */
class TourFactory {
   

    public static function addTour($tourType,  $language, $addId)
    {
       
        if (class_exists($tourType)) {
            return new $tourType($language, $addId);
        } else {
            throw new Exception("Тура не существует");
        }
    }
    
 public static function getTour($tourType,  $language, $id)
    {
       
        if (class_exists($tourType)) {
            return new $tourType($language, $id);
        } else {
            throw new Exception("Тура не существует");
        }
    }
    
    
 public static function getAllTours($tourType,  $language)
    {
       
        if (class_exists($tourType)) {
            return new $tourType($language);
        } else {
            throw new Exception("Тура не существует");
        }
    }
    
    
}
