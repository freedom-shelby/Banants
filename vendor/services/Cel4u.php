<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 19.10.14
 * Time: 0:57
 * API к системе cel4u
 */

use Api\Mobile\V1\Auth;
use \Exception;
use Helpers\Arr;

class Cel4u {

    const ACTION_LOGIN = 1, ACTION_LOGOUT = 2, ACTION_SET_SIM_ACTIVATION_DATE = 9, ACTION_GET_SIM_STATUS = 4, ACTION_GET_NUMBER = 5, ACTION_CONFIRM_REOPT = 6, ACTION_GET_ALL_REPORTS = 7, CHARGE_NUMBER = 8;

    /**
     * Урл к API
     * @var
     */
    protected $_api_url;

    /**
     * Логин и пароль к API
     * @var array
     */
    protected $_api_auth;

    /**
     * Ключ шифрования/Расшифрования
     * @var
     */
    protected $_encript_key;

    /**
     * Название файла кук
     * @var
     */
    protected $_cookie_filename;

    /**
     * Путь к файлу кук
     * @var
     */
    protected $_cookie_filepath;

    /**
     * пересылаемые данные
     * @var
     */
    protected $_request_data;

    /**
     * Флаг подключены ли мы к API
     * @var bool
     */
    protected $_logged_in = false;

    public static $_instance;

    protected $_config;

    public static function instance(){

        if(self::$_instance === null){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Конструктор
     */
    protected function __construct()
    {
        $this->_config = array(
            'api_auth_username' => 'bulltest',
            'api_auth_password' => 'bulltest',
            'api_url' => 'http://cel4u.co.il/sandbox/gateway/gateway1.php',
            'encript_key' => '1La4IuYtRe1sin5ReyCDEFGH'
        );
        $this->_api_url = $this->_config['api_url'];
        $this->_api_auth = array(
            'username' => $this->_config['api_auth_username'],
            'password' => $this->_config['api_auth_password']

        );
        $this->_encript_key = $this->_config['encript_key'];

        $this->generate_cookie_file();

        if(!$this->_logged_in){
            $this->login();
        }
    }

    /**
     * Выполняет запрос
     * @return string
     */
    protected function execute(){

        $ch = curl_init($this->_api_url);
        curl_setopt ($ch, CURLOPT_COOKIEJAR, $this->get_cookie_fullpath());
        curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->get_cookie_fullpath());
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_request_data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);

        $response = $this->valid_response($this->decrypt(curl_exec($ch)));
        //sleep(2);
        return $response;
    }

    /**
     * Авторизация
     * Params:
        - (string)username; //required
        - (string)password; //required
     * @return string
     */
    public function login(){

        $this->request_data(Arr::merge(array('action' => self::ACTION_LOGIN),$this->_api_auth));

        $response = $this->execute();

        $this->_logged_in = true;

        return $this->_logged_in;
    }

    /**
     * Выход
     * Params: none
     */
    public function logout(){
        $this->request_data(array('action' => self::ACTION_LOGOUT));
    }


    /**
     * Изменение даты активации и остальных параметров
     * Es oktagortsum enq vorpisi poxenq sim-i activacman date-y kam urish parametrer.
    Params:
    - (array of objects)numbers;
    Object params:
    - (int)from; //unix timestamp
    - (int)to; //unix timestamp
    - (int)blackberry; //1 kam 0: blackberry-a te che
    - (float)price;
    - (int)freeze; //1 kam 0: freeze anel te chanel 1 tarov
     * @param array $numbers
     * @return string
     */
    public function set_sim_activation_date(array $numbers){
        //при добавлении параметра 'to' => time() выводит ошибку server error
        //какая то бутофория, никакие параметры не утонавливаются
        $this->request_data(array('action' => self::ACTION_SET_SIM_ACTIVATION_DATE,'numbers' => $numbers));
        return $this->execute();
    }

    /**
     * Возвращает статус симки
     * Es oktagortsvuma sim-i status-y yev date-ery imanalu hamar.
        Params:
        - (int)number; //required
        Response:
        - (string)sim_status; //a kam s
        - (string)from;
        - (string)to;
     * @param $number
     * @return array
     */
    public function get_sim_status($number){
        $this->request_data(array('action' => self::ACTION_GET_SIM_STATUS,'number' => $number));
        return $this->execute();
    }

    /**
     * Возвращает номер симки для текущего типа
     * Es oktagortsvuma azat hamar stanalu hamar.
        Params:
        - (int)type; //required
        - (int)simid;
        Response:
        - (int)number;
     * @param $sim_type_alias
     * @param int $sim_number
     * @return string
     */
    public function get_number($sim_type_alias, $sim_number = null){
        if($sim_number == null)
            $this->request_data(array('action' => self::ACTION_GET_NUMBER,'type' => $this->sim_alias_to_api_num($sim_type_alias)));
        else
            $this->request_data(array('action' => self::ACTION_GET_NUMBER,'type' => $this->sim_alias_to_api_num($sim_type_alias),'simid' => $sim_number));
        return $this->execute();
    }

    /**
     * Подтверждение покупки симок
     * Es oktagortsvuma hamarnery hastat plombelu hamar, aysqinqn sranic heto es hamarnery arden unen aktivacman date.
        Params:
        - (array of objects)data;
        Object params:
        - (int)from; //unix timestamp
        - (int)to; //unix timestamp
        - (int)blackberry; //1 kam 0: blackberry-a te che
        - (float)price;
        - (int)freeze; //1 kam 0: freeze anel te chanel 1 tarov
     * @param array $data
     * @return string
     */
    public function confirm_reports(array $data){
        $this->request_data(array('action' => self::ACTION_CONFIRM_REOPT,'data' => $data));
        return $this->execute();
    }

    /**
     * Генерирует/Возвращает данные для запроса
     * Es oktagortsvuma bolor naxkin poxancvats tvyalnery stanalu hamar.
        Params:
        - (array of numbers)data;
        Response:
        - (array of objects)reports;
        Object params:
        - (int)type;
        - (int)number;
        - (string)from;
        - (string)to;
        - (int)package;
        - (float)price;
        - (string)freezedate; //yerba freeze-y prtsnum
        - (string)date; //request date
     * @param null $data
     * @return $this|string
     */
    public function request_data($data = null){
        if($data == null){
            return $this->decrypt($this->_request_data);
        }else{
            $this->_request_data = $this->encrypt($data);
            return $this;
        }
    }


    /**
     * Возвращает полную информацию о сим кртах
     * @param array $sims array(0 => 2456546456, 1=> 67867867)
     * @return array()
     */
    public function get_all_reports(array $sims){
        $this->request_data(array('action' => self::ACTION_GET_ALL_REPORTS, 'data' => $sims));
        return $this->execute();
    }

    /**
     * Возвращает номер симки для текущего типа
     * Es oktagortsvuma azat hamar stanalu hamar.
    Params:
    - (int)type; //required
    - (int)simid;
    Response:
    - (int)number;
     * @param $sim_type_alias
     * @param int $sim_number
     * @return string
     */
    public function charge_number($number, $days = null){
        $this->request_data(array('action' => self::CHARGE_NUMBER,'number' => $number, 'days' => $days));
        return $this->execute();
    }

    /**
     * Шифрование данных
     * @param $text
     * @return string
     */
    public function encrypt($text)
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->_encript_key, json_encode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    /**
     * Расшифрование данных
     * @param $text
     * @return string
     */
    public function decrypt($text)
    {
        return json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->_encript_key, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))),true);
    }

    /**
     * Переводит псевдоним типа симки в номер для API
     * @param $alias
     * @return int
     */
    public static function sim_alias_to_api_num($alias){

        switch($alias){
            case 'regular':
                return 1;
            case 'micro':
                return 2;
            case 'nano':
                return 3;
        }
    }

    /**
     * Переводит номер от API в псевдоним типа симки
     * @param $num
     * @return string
     */
    public static function api_num_to_sim_alias($num){

        switch($num){
            case '1':
                return 'Regular';
            case '2':
                return 'Micro';
            case '3':
                return 'Nano';
        }
    }

    /**
     * Генерирует уникальный файл кук
     * @return string
     */
    private function generate_cookie_file()
    {
        $this->_cookie_filepath = ROOT_PATH.'localstorage/';
        //$this->_cookie_filename = 'cookie_usr_'.Auth::getAuthToken().'.txt';
        $this->_cookie_filename = 'cookie_usr.txt';
        @unlink($this->get_cookie_fullpath());
    }

    /**
     * Возвращает полный путь до файла кук
     * @return string
     */
    protected function get_cookie_fullpath(){
        return $this->_cookie_filepath.$this->_cookie_filename;
    }

    /**
     * По завершению работы подчищаем за нами и выходим
     */
    public function __destruct(){
        @unlink($this->get_cookie_fullpath());
        $this->logout();
    }

    /**
     * Возвращает валидный ответ от сервера
     * @param $response
     * @return mixed
     * @throws Exception
     */
    protected function valid_response($response){

        if(!isset($response['status'])) throw new Exception('Error processing request');

        if($response['status']){
            if(isset($response['error']))
                throw new Exception($response['error']);
            else
                throw new Exception('Error processing request1');
        }

        unset($response['status']);

        if(count($response) == 1){
            foreach($response as $k => $v){
                return $v;
            }
        }
        return $response;
    }

} 