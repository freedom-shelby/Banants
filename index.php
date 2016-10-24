<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 7:06
 * Входная точка
 */
error_reporting(E_ALL);
//ini_set('display_errors', 'On');

/**
 * Устанавливаем корневую директорию
 */
define('ROOT_PATH',dirname(__FILE__).'/');
define('EXT','.php');

/**
 * Настройкий сессии
 */
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_save_path('/tmp');
ini_set('session.gc_probability', 1);

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
use Lang\Lang;
use Lang\I18n;

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

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param  array|string  $key
 * @param  mixed  $default
 * @return mixed
 */
function config($key, $default = null)
{
    if (is_array($key))
    {
        return App::setConfig($key, $default);
    }

    return App::getConfig($key, $default);
}
