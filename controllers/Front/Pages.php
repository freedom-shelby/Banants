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
use Intervention\Image\ImageManagerStatic as Image;
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


    public function getTest2(){
        $this->layout = null;

        $img = Image::cache(function($image) {
            $image->make('5721fc06d139a.jpg')->fit(300)->encode(null, 52);
//            $image->make('5721fc06d139a.jpg')->resize(300)->encode(null, 52);
        }, 12000, true);

//        $img = Image::make('5721fc06d139a.jpg')->resize(300, 300)->greyscale();


//        $img = Image::make('5721fc06d139a.jpg')->crop(300, 300, 200, 600);
//        $img = Image::make('5721fc06d139a.jpg')->fit(400, 200);

//        echo $img->response(null, 10);
//        echo $img->fit(100,100)->response(null, 52);
        echo $img->response();

//        echo "<pre>";
//        print_r($img);
//        die;
    }

    public function getTest3(){
        $this->layout = null;

        $img = Image::make('5721fc06d139a.jpg');

//        $img = Image::make('5721fc06d139a.jpg')->resize(300, 300)->greyscale();


//        $img = Image::make('5721fc06d139a.jpg')->crop(300, 300, 200, 600);
//        $img = Image::make('5721fc06d139a.jpg')->fit(400, 200);

        echo $img->resize(300, 300)->response(null, 52);
    }
}