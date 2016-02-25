<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Front;

restrictAccess();

use View;

class Pages extends Front
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Главная страница сайта
     */
    public function getHome(){

        $chargerContainer = View::make('front/charge-steps/container')
            ->with('content',View::make('front/charge-steps/step1'));
//            ->with('content',View::make('front/charge-steps/step1',['countries' => \CountryModel::getChargableCountries()]));
        $this->layout->content = View::make('front/home')->with('content',$chargerContainer);
    }

    public function getAbout(){
        $this->layout->content = View::make('front/about');
    }

    public function getHowToTopUp(){
        $this->layout->content = View::make('front/topup');
    }

    public function getNews(){
        $this->layout->content = View::make('front/news');
    }

    public function getFaq(){
        $this->layout->content = View::make('front/faq');
    }

    public function getTest(){
//        print_r(\Settings::instance()->get_all_groups());

        //$this->layout = \CountryModel::with('PhoneInfo')->with('TopUpServices')->get();
        //$this->layout = \CountryPhoneInfoModel::where('id','=',1)->get();
        //$this->layout = \TopupServiceModel::get();
        $this->layout = null;
        //var_dump(\CountryModel::getChargableCountries()->toJson());
        //var_dump(\CountryModel::getChargableCountries()[0]->phoneInfo->code);
        //var_dump(\CountryModel::getCountryWithApiData(1)->toJson());

    }
}