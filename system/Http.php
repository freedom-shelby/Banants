<?php  restrictAccess();
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 7:09
 * Класс работающий с протоколом HTTP получающий и устанавливающий заголовки и тела запросов
 */
use HTTP\Exception as HTTPException;
class Http {

    /**
     * Хранит глобальную переменную $_REQUEST
     * @var array
     */
    private $_request;

    /**
     * Хранит глобальную переменную $_POST
     * @var array
     */
    private $_post;

    /**
     * Хранит глобальную переменную $_GET
     * @var array
     */
    private $_get;

    /**
     * Хранит глобальную переменную $_SERVER
     * @var array
     */
    private $_server;

    /**
     * Хранит заголовки запроса
     * @var array
     */
    private $_headers;

    /**
     * Хранит дополнительные заголовки ответа
     * установленные вручную
     * @var array
     */
    private $_responceHeaders = array();

    /**
     * Необработанные POST данные
     * Данные полученные из POST запроса
     * с помощю директивы php://input
     * @var string
     */
    private $_rawPostData;

    public function __construct(){
        $this->_headers = getallheaders();
        $this->_request = $_REQUEST;
        $this->_post = $_POST;
        $this->_get = $_GET;
        $this->_server = $_SERVER;
        $this->_rawPostData = file_get_contents('php://input');
//        unset($_POST,$_SERVER,$_GET,$_REQUEST);
        $this->phpExpose();
        $this->checkHeaders();
    }

    /**
     * Маскируемся под ASP.NET
     */
    private function phpExpose(){
        header("X-Powered-By: ASP.NET");
    }

    /**
     * Возвращает заголовки сервера
     * @return mixed
     */
    public function headers(){
        return $this->_headers;
    }


    /**
     * Проверка хоста
     * @throws HTTPException
     */
    private function checkHeaders(){
        if($this->_server["HTTP_HOST"] != $this->_headers["Host"]){
            throw new HTTPException(404);
        }
    }

    /**
     * Возвращает имя хоста
     * @return mixed
     */
    public function getHostName(){
        return $this->_server['HTTP_HOST'];
    }

    /**
     * Возвращает IP аддрес
     * @return mixed
     */
    public function getIpAddress(){
        return $this->_server['REMOTE_ADDR'];
    }

    /**
     * ВОзвращает строку запроса
     * @return string
     */
    public function getURI(){
        return strtok($this->_server['REQUEST_URI'],'?');
    }

    /**
     * Возвращает тип запроса
     * @return string
     */
    public function getRequestType(){
        return strtolower($this->_server['REQUEST_METHOD']);
    }

    /**
     * Возвращает протокол запроса
     * @return string
     */
    public function getProtocol(){
        return stripos($this->_server['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    }

    /**
     * Возвращает данные полученные из POST запроса
     * с помощю директивы php://input
     */
    public function getRawPostData(){
        return $this->_rawPostData;
    }

    /**
     * Возвращает определённый заголовок
     * если он существует, иначе null
     * @param $name
     * @return string|null
     */
    public function getHeaderData($name){
        return isset($this->_headers[ucfirst(strtolower($name))]) ? $this->_headers[ucfirst(strtolower($name))] : null;
    }

    /**
     * Регистрирует определённый заголовок ответа
     * @param string $name название заголовка
     * @param string $value значение
     */
    public function setResponceHeader($name,$value){
        $this->_responceHeaders[ucfirst(strtolower($name))] = $value;
    }

    /**
     * Регистрирует заголовки ответа
     * @param array $headersKeyVal
     */
    public function setResponceHeaders(array $headersKeyVal){
        foreach($headersKeyVal as $name => $value){
            $this->setResponceHeader($name,$value);
        }
    }

    /**
     * Устанавливает зарегистрированные заголовки ответа
     */
    public function fireHeaders(){
        foreach($this->_responceHeaders as $name => $val){
            header($name.': '.$val);
        }
    }

    /**
     * Позвращает данные из $_POST
     * @return array
     */
    public function getPostData(){
        return $this->_post;
    }

    /**
     * Позвращает данные из $_POST
     * @return array
     */
    public function getServerData(){
        return $this->_server;
    }

    /**
     * Позвращает данные из $_REQUEST
     * @return array
     */
    public function getRequestData(){
        return $this->_request;
    }

    /**
     * Устанавливает заголовок статуса ошибки
     * @param string $msg
     */
    public function setHeaderErrorMessage($msg = CCN_MSG_NO_ERRORS){
        $this->setResponceHeader(HTTP_HEADER_ERROR__MSG,$msg);

    }
}