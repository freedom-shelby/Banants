<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 26.01.2016
 * Time: 23:20
 */

/**
 * TEST TEST TEST
 */

namespace Test;


class WordTranslate extends \Controller
{
    public function anyIndex()
    {

//        \Lang::instance()->setCurrentLang('am');
//        var_dump(function_exists('__'));
        echo __('World :name', [':name' => 'John']);


    }
}