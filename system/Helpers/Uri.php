<?php
/**
 * Created by PhpStorm.
 * User: Ara
 * Date: 11/6/2015
 * Time: 6:35 PM
 */

namespace Helpers;


use Lang\Lang;

class Uri
{
    public static function makeRouteUri($routName){
        $route = \Router::findRouteByName($routName);
        if($route){
            $protocol = \App::instance()->http()->getProtocol();
            $host = \App::instance()->http()->getHostName();
            $ext = (!strlen(trim($route->getUri(),'/')) ? null :\App::URI_EXT);
            return $protocol.$host.$route->getUri().$ext;
        }
    }

    public static function makeUri($uri)
    {
        if((strpos('http:\\', $uri) !== false) || (strpos('https:\\', $uri) !== false)) return $uri;

        return implode('/', [Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'], ltrim($uri, '/')]);
    }

    //static function to redirect to other page
    public static function to($url){

        $url = $url . \App::URI_EXT;

        header('Location: ' . $url, true, 302);
        exit;
    }
}