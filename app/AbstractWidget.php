<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отображения элементов страницы
 * по средствам его методов
 */

abstract class AbstractWidget {

    /**
     * Тип страницы
     */
    protected $_type;

    public function getPosition(){}
    public function getSorting(){}
    public function render(){}
    public function init(){}


} 