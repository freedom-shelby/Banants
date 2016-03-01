<?php
restrictAccess();
/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 01.03.2016
 * Time: 1:29
 * Прослойка между генератором событий и клиентом
 * существует для того чтоб на прямую и статично обращатся к публичным методам Event\Emmiter
 * например: для того чтобы вызвать метод Event\Emmiter::fire нужно написать Event::fire
 */
class Event
{
    private static $_instance;

    private function __construct(){
        $this->_emmiter = new Event\Emmiter();
        $this->_emmiter->findAutoSubscribers();
    }
    private function __clone(){}
    private function __wakeup(){}

    private $_emmiter;

    public static function instance(){

        if(static::$_instance === NULL){
            static::$_instance = new Event();
        }

        return static::$_instance;
    }



    public static function __callStatic($method, $parameters){
        return call_user_func_array(array(static::instance()->_emmiter, $method), $parameters);
    }
}