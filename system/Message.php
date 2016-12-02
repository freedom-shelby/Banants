<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 17.03.2015
 * Time: 19:18
 * Класс для обмена сообщениями в приложении
 */

use Helpers\Arr;


class Message {

    /**
     * типы сообщений
     */
    const SUCCESS = 'success', INFO = 'info', DANGER = 'danger', WARNING = 'warning';

    /**
     * Экземпляр класса
     * @var Message
     */
    private static $_instance;

    /**
     * Название переменной сессии
     * @var string
     */
    private $_session_name = 'hdvp_messages';

    /**
     * Сообщения
     * @var array
     */
    private $_messages;

    /**
     * Успешное сообщение
     * @param $messages
     * @return void
     */
    public function success($messages){
        $this->set(static::SUCCESS,$messages);
    }

    /**
     * Информационное сообщение
     * @param $messages
     * @return $this
     */
    public function info($messages){
        $this->set(static::INFO,$messages);
    }

    /**
     * Предупреждающее сообщение
     * @param $messages
     * @return $this
     */
    public function warning($messages){
        $this->set(static::WARNING,$messages);
    }

    /**
     * Опасное сообщение (Ошибка)
     * @param $messages
     * @return $this
     */
    public function danger($messages){
        $this->set(static::DANGER,$messages);
    }

    public function get($type){
        $output = '';
        if(!empty($this->_messages[$type])){
            foreach($this->_messages[$type] as $message){
                $output .= $message.'</br>';
            }
            $output = rtrim($output,'</br>');
        }
        return self::render($output, $type);
    }

    public function set($type,$messages){
        if(is_string($messages)){
            $this->_messages[$type][] = $messages;
        }elseif(is_array($messages)){
            isset($this->_messages[$type]) ? Arr::merge($this->_messages[$type],$messages) : ($this->_messages[$type] = $messages);
        }
        $this->save();
    }
    
    public function clear($type = null){

        if($type) {
            unset($this->_messages[$type]);
        }else {
           $this->_messages = [];
        }
        $this->save();
    }

    public function flash($type){
        $output = $this->get($type);
        unset($this->_messages[$type]);
        $this->save();
        return $output;
    }

    public function get_all(){
        $output = '';
        if(!empty($this->_messages)){
            foreach($this->_messages as $type => $messages){
                if(!empty($messages)){
                    $type_output = '';
                    foreach($messages as $message){
                        $type_output .= $message.'</br>';
                    }
                    $type_output = rtrim($type_output,'</br>');
                }

                $output .= self::render($type_output, $type);
            }
        }

        return $output;
    }

    public function flash_all()
    {
        $output = $this->get_all();
        $this->_messages = [];
        $this->save();
        return (string) $output;
    }

    private function __construct(){
        if(!isset($_SESSION)) {
            session_start();
        }

        if(isset($_SESSION[$this->_session_name])) {
            $this->_messages = $_SESSION[$this->_session_name];
        }
    }

    private function save(){
        $_SESSION[$this->_session_name] = $this->_messages;
    }

    /**
     * генерирует сообшения
     * @param $message
     * @param string $alert_type
     * @return View
     */
    public static function render($message, $alert_type = 'info'){
        $output = '';
        $output .= '<div class="alert alert-'.$alert_type.'">';
        $output .=      '<button type="button" class="close" data-dismiss="alert">×</button>';
        $output .=      $message;
        $output .= '</div>';

        return $output;
    }

    private function __clone(){}
    private function __wakeup(){}

    public static function instance(){

        if(static::$_instance === NULL){
            static::$_instance = new self();
        }

        return static::$_instance;
    }
}