<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 7:06
 * Входная точка
 */
error_reporting(E_ALL);
/**
 * Устанавливаем корневую директорию
 */
define('ROOT_PATH',dirname(__FILE__).'/');
define('EXT','.php');

/**
 * Подключаем и регистрируем автозагрузчик
 */

require_once(ROOT_PATH . 'vendor/autoload' . EXT);

//Инициализация событийной модели
Event::instance();


Event::fire('App.beforeAppStart',null);
//Запуск приложения
App::start();

/**
 * Ограничивает доступ к файлу напрямую из адресной строки
 * todo:: перенести все эту функцию в отдельный файл с такими же функциами-помошниками
 */
function restrictAccess(){
    if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
}

use Lang\Lang;
use Lang\I18n;

/**
 * translation/internationalization function. The PHP function
 * [strtr](http://php.net/strtr) is used for replacing parameters.
 *
 *    __('Welcome back, :user', array(':user' => $username));
 *
 * [!!] The target language is defined by [Lang::instance()->getCurrentLang()].
 *
 * @uses    I18n::get
 * @param   string  $string text to translate
 * @param   array   $values values to replace in the translated text
 * @param   string  $lang   source language
 * @return  string
 */
function __($string, array $values = NULL, $lang = null)
{
    if( ! $lang){
        $lang = Lang::instance()->getCurrentLang()['iso'];
    }

    if ($lang !== Lang::DEFAULT_LANGUAGE)
    {
        // The message and target languages are different
        // Get the translation for this message
        $string = I18n::get($string, $lang);
    }

    return empty($values) ? $string : strtr($string, $values);
}
