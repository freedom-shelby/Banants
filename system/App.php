<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 7:07
 * Ядро API CCN - Currency Clearing Network
 */

class App {

    /**
     * Название и версия
     */
    const ABBR = "FCB", CODE_NAME = "Banants", VERSION = "1.0.0.0";

    /**
     * Приставка к URL
     */
    const URI_EXT = ".html";

    /**
     * Храните экземпляр ядра
     * @var App
     */
    private static $_instance;

    /**
     * Экземпляр класса для работы с Http
     * @var Http
     */
    private $_http;


    private static $_config = [
        'base_url' => '/', //базовый урл
        'native_hash_key' => '$SHELBY$', //Дефолтный ключ шифрования
    ];

    /**
     * Сообщения
     * @var array
     */
    private static $_messages = [];

    private function __clone(){}
    private function __wakeup(){}
    private function __construct(){
        $this->_http = new Http();
    }

    public static function instance(){
        if(empty(static::$_instance)){
            static::$_instance = new static();
            static::$_messages = include_once (ROOT_PATH.'messages/errors'.EXT);
            if( ! class_exists('I18n')){
                include_once(ROOT_PATH.'system/Langs/I18n'.EXT);
            }
//            include_once(ROOT_PATH.'system/I18n'.EXT);
//            Langs::instance();            var_dump(Langs::instance()->getCurrentLang());die;

        }
        return static::$_instance;
    }

    /**
     * Начинает работу приложения
     */
    public static function start(){
        static::instance();
        Router::startWorking();
    }

    /**
     * Возвращает базовый урл сайта
     * @return string
     */
    public static function baseUrl($absolute = false){
        return ($absolute) ? (App::instance()->http()->getProtocol().App::instance()->http()->getHostName().static::getConfig('base_url')) : static::getConfig('base_url');
    }

    /**
     * Возвращает заданный параметр конфигурации
     */
    public static function getConfig($key){
        return static::$_config[$key];
    }

    /**
     * Возвращает объект http
     * @return \Http
     */
    public function http(){
        return $this->_http;
    }


    /**
     * Возвращает родной ключ хеширования
     * @return mixed
     */
    public function getNativeHashKey(){
        return static::getConfig('native_hash_key');
    }

    /**
     * Возвращает сообщение
     * @param $msg
     * @return null
     */
    public static function getMessage($msg){
        return isset(static::$_messages[$msg]) ? static::$_messages[$msg] : null;
    }
}