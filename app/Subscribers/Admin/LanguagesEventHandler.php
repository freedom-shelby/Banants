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
use LangModel;

class LanguagesEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением материала
     */
    public static function onBeforeLanguageUpdate(){
        $cache = new Cache();
        $cache->setLocalPath('languages');
        $cache->clear();

    }

    /**
     * Метод обрабатывающий событие обновления материала
     */
    public static function onLanguageUpdate(){
        Message::instance()->success('Language was successfully saved');

        // Очишает кеш
        $cache = new Cache();
        $cache->setLocalPath('languages');
        $cache->clear();

        // Добовляет нрвий кеш
        $items = LangModel::where('status', '=', '1')->get();
        $cache->setData($items);
        $cache->save();

    }

    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Admin.languageUpdate',__NAMESPACE__.'\LanguagesEventHandler@onLanguageUpdate');
        $events->listen('Admin.beforeLanguageUpdate',__NAMESPACE__.'\LanguagesEventHandler@onBeforeLanguageUpdate');
    }
}