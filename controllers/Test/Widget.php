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


use Widgets\WidgetsContainer;

class Widget extends \Controller
{
    public function anyIndex()
    {

        new WidgetsContainer(\ArticleModel::find(1));

    }
}