<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 5:43
 */
namespace Subscribers\Admin;
restrictAccess();


use Lang\Lang;
use Message;
use Cache\LocalStorage as Cache;
use LangModel;

class EntitiesEventHandler
{

    /**
     * Метод обрабатывающий событие обновления транслиаций
     */
    public static function onEntitiesUpdate(){
        // Очишает кеш
        $cache = new Cache();
        foreach(Lang::instance()->getLangs() as $lang) {
            $cache->setLocalPath($lang['iso'] . '_I18n');
            $cache->clear();
        }

    }

    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Admin.entitiesUpdate',__NAMESPACE__.'\EntitiesEventHandler@onEntitiesUpdate');
    }
}