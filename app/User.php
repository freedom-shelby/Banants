<?php
/**
 * Created by Arsen.
 * Date: 14.10.14
 * Time: 13:40
 * Класс настроек приложения
 * Паттерн одиночка(Singleton)
 */
restrictAccess();
use Cache\LocalStorage as Cache;

class User {

    public static $_instance;

    protected $_items = [];

    protected $_userModel;

    /**
     * Точка доступа
     * @return User
     */
    public static function instance(){

        if(self::$_instance === null){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Конструктор
     */
    protected function __construct(){
        $this->_userModel = UserModel::firstOrCreate([
            'ip' => App::instance()->http()->getIpAddress()
            ]);
    }

    /**
     * Возврошает ID ползователя
     * @return UserModel->id
     */
    public function getId()
    {
        return $this->_userModel->id;
    }

    /**
     * Возврошает IP ползователя
     * @return mixed
     */
    public function getIp()
    {
        return $this->_userModel->ip;
    }
} 