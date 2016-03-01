<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 01.03.2016
 * Time: 4:50
 */
namespace Subscribers\Route;

class GlobalEventHandler
{
    /**
     * Метод обрабатывающий событие о не верном переходе
     * @param $route \Route
     */
    public static function onInvalidRoute($route){

         header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");
        exit;
    }

    /**
     * Метод обрабатывающий событие до отработки роута
     * @param $route \Route
     */
    public static function onBeforeRouteExecute($route){


    }

    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('App.invalidRoute',__NAMESPACE__.'\GlobalEventHandler@onInvalidRoute');
        $events->listen('App.beforeRouteExecute',__NAMESPACE__.'\GlobalEventHandler@onBeforeRouteExecute');
    }
}