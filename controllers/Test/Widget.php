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


class Widget extends \Controller
{
    public function anyIndex()
    {

//        \Langs::instance()->setCurrentLang('am');
//        var_dump(function_exists('__'));
        echo __('World :name', [':name' => 'John']);


    }
}