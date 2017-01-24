<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 5:43
 */
namespace Subscribers\Admin;
restrictAccess();


use Message;
use Cache\LocalStorage as Cache;

class MenusEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением материала
     */
    public static function onBeforeMenuUpdate(){
        $cache = new Cache();
        $cache->clearAll();

    }

    /**
     * Метод обрабатывающий событие обновления материала
     */
    public static function onMenuUpdate(){
        $cache = new Cache();
        $cache->clearAll();
        //todo:: Можно было бы сразу сгенерировать ключ, если материал вместе с контентом бы шёл
//        $cache->setData($menu);
//        $cache->save();

    }


    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Admin.menuUpdate',__NAMESPACE__.'\MenusEventHandler@onMenuUpdate');
        $events->listen('Admin.beforeMenuUpdate',__NAMESPACE__.'\MenusEventHandler@onBeforeMenuUpdate');
    }
}