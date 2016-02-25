<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 25.02.2016
 * Time: 5:37
 * Класс-помошник для работы с  темой(со страницей)
 */
use Widgets\WidgetsContainer as WgtContainer;

class Theme
{
    private $_themePath;
    private $_assetPath;
    private $_assets = ['js' => [], 'css' => [], 'img' => []];

    /**
     * Отрисовывыет виджеты для данной позиции
     * @param string $position позиция виджетов
     * @return mixed
     */
    public static function drawWidgets($position){
        return WgtContainer::instance()->draw($position);
    }


}