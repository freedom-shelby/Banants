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

class SettingsEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением Setting-ов
     */
    public static function onSettingsUpdate(){
        $cache = new Cache();
        $cache->setLocalPath('settings');
        $cache->clear();
        Message::instance()->success('Setting has successfully saved');

    }

    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Admin.settingsUpdate',__NAMESPACE__.'\SettingsEventHandler@onSettingsUpdate');
    }
}