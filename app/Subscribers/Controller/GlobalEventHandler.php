<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 3:22
 */
namespace Subscribers\Controller;

use Widgets\WidgetsContainer;

restrictAccess();
class GlobalEventHandler
{
    /**
     * Метод обрабатывающий событие о не верном переходе
     * @param $controller
     */
    public static function onActionExecute($controller){
        $slug = $controller->getRequestParam('page') ?: null;
        if($slug){
            WidgetsContainer::instance($slug);
        }

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
        $events->listen('Controller.beforeActionExecuted',__NAMESPACE__.'\GlobalEventHandler@onActionExecute');
    }
}