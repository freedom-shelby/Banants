<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 5:43
 */
namespace Subscribers\Football;
restrictAccess();


use Message;
use Cache\LocalStorage as Cache;

class TournamentEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением материала
     * @param $article \ArticleModel
     */
    public static function onEventUpdate($article){
//        $cache = new Cache();
//        $cache->setLocalPath($article->slug.'_article');
//        $cache->clear();

    }

    /**
     * Метод обрабатывающий событие обновления материала
     * @param $article \ArticleModel
     */
    public static function onTableUpdate($article){
//        Message::instance()->success('Article was successfully saved');
//        $cache = new Cache();
//        $cache->setLocalPath($article->slug.'_article');
//        $cache->clear();
//        $cache->setData($article);
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