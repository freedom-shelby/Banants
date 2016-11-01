<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 5:43
 */
namespace Subscribers\Football;
restrictAccess();


use Football\Tournaments\Types\AbstractType;
use Football\Tournaments\Types\DoubleRoundRobin;
use Message;
use Cache\LocalStorage as Cache;

class TournamentEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением материала
     * @param $tournament DoubleRoundRobin
     *
     * todo:: avelacnel AbstracType -um vor @ndhanur sagh turnirneri hamar lini generateTabel -en
     */
    public static function onEventUpdate($tournament){
//        $cache = new Cache();
//        $cache->setLocalPath($tournament->slug.'_article');
//        $cache->clear();

        $tournament->generateTable();
    }

    /**
     * Метод обрабатывающий событие обновления материала
     * @param $tournament AbstractType
     */
    public static function onTableUpdate($tournament){
//        Message::instance()->success('Article was successfully saved');
//        $cache = new Cache();
//        $cache->setLocalPath($tournament->slug.'_article');
//        $cache->clear();
//        $cache->setData($tournament);
//        $cache->save();

    }
    
    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Football.eventUpdate',__NAMESPACE__.'\TournamentEventHandler@onEventUpdate');
        $events->listen('Football.tableUpdate',__NAMESPACE__.'\TournamentEventHandler@onTableUpdate');
    }
}