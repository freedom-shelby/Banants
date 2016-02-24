<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 13:08
 * Ujkjdyjq rjynhjk ghbkj;tybz
 */

class Controller {

    /**
     * Экземпляр приложения
     * @var App
     */
    protected $_app;

    protected $_requestParams;

    public $layout;

    /**
     * Установка шаблона отображения
     */
    public function setLayout(){

    }

    public function __construct(array $requestParams = []){
        $this->_app = App::instance();
        $this->setLayout();
        $this->_requestParams = $requestParams;
    }

    public function __destruct(){
        if($this->layout){
            echo $this->layout;
        }
    }

    protected function getRequestParam($param, $default = null){
        return $this->_requestParams[$param] ?:$default;
    }

    protected function getPostData($param = null, $default = null){
        $postData = $this->_app->http()->getPostData();
        if(!$param) return $postData;
        return isset($postData[$param]) ? $postData[$param]  : $default;
    }
}