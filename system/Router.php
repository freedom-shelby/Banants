<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 11.02.2015
 * Time: 9:53
 */

class Router {

    /**
     * Список роутов
     * @var array
     */
    protected static $_routes;

    /**
     * Выполняем действие в зависимости от метода
     * (нужно для удобства)
     * @param $name
     * @param $args
     */
    public static function __callStatic($name,$args){

        switch($name){
            case 'get' : static::makeRouteGet($args); break;
            case 'post' : static::makeRoutePost($args); break;
            case 'any' : static::makeRouteAny($args); break;
        }
    }

    /**
     * Добавление роута работающего через GET запрос
     * @param $params
     * @throws \Exception
     */
    protected static function makeRouteGet($params){
        $route = new Route();
        static::addRoute($route->init($params,'get'));
    }

    /**
     * Создание роута работающего через POST запрос
     * @param $params
     * @throws \Exception
     */
    protected static function makeRoutePost($params){
        $route = new Route();
        static::addRoute($route->init($params,'post'));
    }

    /**
     * Создание роута работающего через любой
     * @param $params
     * @throws \Exception
     */
    protected static function makeRouteAny($params){
        $route = new Route();
        static::addRoute($route->init($params,'any'));
    }

    /**
     * Добавление роута в список роутов
     * @param Route $route
     */
    protected static function addRoute(Route $route){
        static::$_routes[$route->getName()] = $route;
    }

    public static function startWorking(){
        $route = static::getCurrentRoute();

        if($route){
           echo $route->execute();
        }else{
            header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");
        }
    }

    /**
     * Возвращает роут находя его по строке запроса
     * @param $uri
     * @return bool
     */
    public static function findRouteByURI($uri){
        foreach(static::$_routes as $r){
            if ($r->matchURI(urldecode($uri)) AND $r->requestIsValid()){
                return $r;
            }

        }

        return false;
    }

    /**
     * @param $routeName
     * @return \Route
     */
    public static function findRouteByName($routeName){
        foreach(static::$_routes as $r){
            if ($r->getName() == $routeName){
                return $r;
            }

        }

        return false;
    }

    /**
     * Возвращает текущий роут
     * @return \Route|false
     */
    public static function getCurrentRoute(){
        return static::findRouteByURI(App::instance()->http()->getURI());
    }


}