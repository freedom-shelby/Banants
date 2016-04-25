<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();


use View;

class Pages extends Back
{
    /**
     * Главная страница сайта
     */
    public function getHome(){
        $this->layout->content = View::make('back/home');
    }

    public function getTest(){

//        $this->layout = null;

        $chargerContainer = View::make('site/charge-steps/container')
            ->with('content',View::make('site/charge-steps/step1',['countries' => \CountryModel::getChargableCountries()]));
        $this->layout->content = View::make('site/home')->with('content',$chargerContainer);
    }
}