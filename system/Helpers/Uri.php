<?php
/**
 * Created by PhpStorm.
 * User: Ara
 * Date: 11/6/2015
 * Time: 6:35 PM
 */

namespace Helpers;


use Lang\Lang;
use App;

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

    public static function makeUriFromId($uri)
    {
        // Если это внешний УРЛ
        if((strpos('http:\\', $uri) !== false) || (strpos('https:\\', $uri) !== false)) return $uri;

        // Если это Домашная страница
        if($uri == '/'){
            if(! Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso']) return $uri;
            return '/' . Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'];
        }

        // Приклепляет к УРЛ '/' . текуший язык . сам УРЛ . расширение сайта
        return '/'.ltrim(Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'] . '/' . ltrim($uri, '/'),'/') . App::URI_EXT;
//        return '/'.ltrim(implode('/', [Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'], ltrim($uri, '/')]),'/') . App::URI_EXT;
    }

    //static function to redirect to other page
    public static function to($url){

        $url = $url . \App::URI_EXT;

        header('Location: ' . $url, true, 302);
        exit;
    }
}