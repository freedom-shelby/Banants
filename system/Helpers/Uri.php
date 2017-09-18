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
        if((strpos($uri, 'http:\\') !== false) || (strpos($uri, 'https:\\') !== false)) return $uri;
        if((strpos($uri, 'http://') !== false) || (strpos($uri, 'https://') !== false)) return $uri;

        return implode('/', [Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'], ltrim($uri, '/')]);
    }

    public static function makeUriFromId($uri)
    {
        return self::makeUrl($uri); // todo:: bolor tegherum makeUriFromId -ov funkciayi kanch@ poxel makeUrl;
    }

    public static function makeUrl($uri)
    {

        // Если это внешний УРЛ
        if((strpos($uri, 'http:\\') !== false) || (strpos($uri, 'https:\\') !== false)) return $uri;
        if((strpos($uri, 'http://') !== false) || (strpos($uri, 'https://') !== false)) return $uri;

        // Если это Домашная страница
        if($uri == '/'){
            if(! Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso']) return $uri;
            return '/' . Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'];
        }

        $uriId = '';

        if(strpos($uri, '#')){
            $uriId = '#' . self::getIdFromSlug($uri);
            $uri = self::deleteIdFromSlug($uri);
        }

        // Приклепляет к УРЛ '/' . текуший язык . сам УРЛ . расширение сайта . ИД в УРЛ
        return '/'.ltrim(Lang::instance()->getCurrentLangExceptPrimary()['iso'] . '/' . ltrim($uri, '/'),'/') . App::URI_EXT . $uriId;
//        return '/'.ltrim(implode('/', [Lang::instance()->getCurrentLangExcept(Lang::instance()->getPrimaryLang()['iso'])['iso'], ltrim($uri, '/')]),'/') . App::URI_EXT;
    }

    //static function to redirect to other page
    public static function to($url){

        // Если это Домашная страница
        if($url == '/'){
            if(Lang::instance()->getCurrentLangExceptPrimary()['iso']) {
                $url = '/' . Lang::instance()->getCurrentLangExceptPrimary()['iso'];
            }
        }else{
            $url = $url . App::URI_EXT;
        }

        header('Location: ' . $url, true, 302);
        exit;
    }

    //static function to redirect to file
    public static function toFile($url){

        header('Location: /' . trim($url, '/'), true, 302);
        exit;
    }

    /**
     * Удаляет # ИД из ссилки
     * @param $slug
     * @return mixed
     */
    public static function deleteIdFromSlug($slug){

        // Вырезает из строки ИД (самий бистрий способ;))
        $pos = strpos($slug, '#');
        if ($pos !== false) {
            $slug = substr_replace($slug, '', $pos); // Вырезает остаток от #
        }

        return $slug;
    }

    public static function getIdFromSlug($slug){

        $pos = strpos($slug, '#');
        if ($pos !== false) {
            $slug = explode('#', $slug);
        }

        return end($slug);
    }
}