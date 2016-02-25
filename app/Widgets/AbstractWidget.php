<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отабражения элементов страницы
 * по средствам его методов
 */
namespace Widgets;
restrictAccess();
abstract class AbstractWidget {


    /**
     * Тип виджета
     */
    protected $_type;

    public function getPosition(){}
    public function getSorting(){}
    public function render(){}
    public function init(){}


} 