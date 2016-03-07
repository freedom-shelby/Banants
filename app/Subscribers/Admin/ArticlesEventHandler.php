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

class ArticlesEventHandler
{

    /**
     * Метод обрабатывающий событие перед обновлением материала
     * @param $article \ArticleModel
     */
    public static function onBeforeArticleUpdate($article){
        $cache = new Cache();
        $cache->setLocalPath($article->slug.'_article');
        $cache->clear();

    }

    /**
     * Метод обрабатывающий событие обновления материала
     * @param $article \ArticleModel
     */
    public static function onArticleUpdate($article){
        Message::instance()->success('Article was successfully saved');
        $cache = new Cache();
        $cache->setLocalPath($article->slug.'_article');
        $cache->clear();
        //todo:: Можно было бы сразу сгенерировать ключ, если материал вместе с контентом бы шёл
//        $cache->setData($article);
//        $cache->save();

    }


    /**
     * Подписка на события
     * @param $events
     */
    public static function subscribe($events){
        //Подписываемся на событие о не верном переходе
        $events->listen('Admin.articleUpdate',__NAMESPACE__.'\ArticlesEventHandler@onArticleUpdate');
        $events->listen('Admin.beforeArticleUpdate',__NAMESPACE__.'\ArticlesEventHandler@onBeforeArticleUpdate');
    }
}