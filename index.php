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
