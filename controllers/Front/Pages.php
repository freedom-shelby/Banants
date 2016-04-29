<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Front;
restrictAccess();


use Http\Exception as Exception;
use View;
use ArticleModel;

use Widgets\WidgetsContainer;

class Pages extends Front
{

    public function __construct(array $requestParams)
    {
        parent::__construct($requestParams);
//        WidgetsContainer::instance();
    }

    /**
     * Главная страница сайта
     */
    public function getHome()
    {
//        $slug = 'home';
//        $this->_page->initFromSlug($slug);

        $this->_page->setTitle('Официальный сайт FC Banants');
//        $this->_page->setContent('Тестовый контент');

//        $model = ArticleModel::where('slug','=','home')->first();
//        WidgetsContainer::instance($model);
//
        $this->layout = View::make('front/home');
        $this->layout->content = View::make('front/content/pages/home');
    }

    public function getPage()
    {
        $slug = $this->getRequestParam('page') ?: null;

        $this->_page->initFromSlug($slug);

//        $this->layout->content = View::make('front/content/pages/page');

    }


    public function getTest(){
//        $slug = 'home';
//        $this->_page->initFromSlug($slug);

        $this->_page->setTitle('Официальный сайт FC Banants');
//        $this->_page->setContent('Тестовый контент');

//        $model = ArticleModel::where('slug','=','home')->first();
//        WidgetsContainer::instance($model);
//
        $this->layout = View::make('test/index');
        $this->layout->content = View::make('test/Test_1');

    }
}