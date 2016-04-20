<?php restrictAccess();
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

    public function dispose(){
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

    protected function getCurrentUri(){
        return $this->_app->http()->getURI();
    }
}