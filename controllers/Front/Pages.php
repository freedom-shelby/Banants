<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Front;
restrictAccess();


use Http\Exception;
use View;
use ArticleModel;
use Widgets\WidgetsContainer;

class Pages extends Front
{

    /**
     * Главная страница сайта
     */
    public function getHome()
    {
        $this->_page->setTitle('Оффициальный сайт FC Banants');
        $this->_page->setContent('Тестовый контент');
//        $model = ArticleModel::where('slug','=','home')->first();
//        WidgetsContainer::instance($model);
//
//        $this->layout->content = View::make('front/content/pages/home');
    }

    public function getPage()
    {
        $slug = $this->getRequestParam('page') ?: null;

        $model = ArticleModel::where('slug','=',$slug)->first();

        if(empty($model)){
            throw new Exception(404);
        }

        WidgetsContainer::instance($model);

        $this->layout->content = View::make('front/content/pages/page');
    }


    public function getTest(){
//        print_r(\Settings::instance()->getAllGroups());

        //$this->layout = \CountryModel::with('PhoneInfo')->with('TopUpServices')->get();
        //$this->layout = \CountryPhoneInfoModel::where('id','=',1)->get();
        //$this->layout = \TopupServiceModel::get();
        $this->layout = null;
        //var_dump(\CountryModel::getChargableCountries()->toJson());
        //var_dump(\CountryModel::getChargableCountries()[0]->phoneInfo->code);
        //var_dump(\CountryModel::getCountryWithApiData(1)->toJson());

    }
}