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

//Запуск приложения
App::start();

/**
 * Ограничивает доступ к файлу напрямую из адресной строки
 * todo:: перенести все эту функцию в отдельный файл с такими же функциами-помошниками
 */
function restrictAccess(){
    if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
}