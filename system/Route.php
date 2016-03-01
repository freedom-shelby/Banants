<?php restrictAccess();
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 10.02.2015
 * Time: 17:37
 */

//route::get('sdsdfsdfsd/{id}','Controller@action',[]);
//route::post('dsfdsf');

use Lang\Lang;


class Route {

    /**
     * Адрес роута
     * @var
     */
    protected $_uri;

    /**
     * Контроллер роута
     * @var
     */
    protected $_controller;

    /**
     * Экшн контроллера роута
     * @var
     */
    protected $_action;

    /**
     * Тип обрабатываемого запроса роутом
     * @var
     */
    protected $_type;

    /**
     * Правила валидации
     * @var
     */
    protected $_rules;

    /**
     * Название роута
     * @var
     */
    protected $_name;

    /**
     * Переменные которые должны быть переданны в экшен
     * @var
     */
    protected $_actionVaribles;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Установка адреса роута
     * @param mixed $uri
     */
    protected function setUri($uri)
    {
        $this->_uri = $uri;
    }

    /**
     * Возвращает контроллер роута
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * Установка контроллера роута
     * @param mixed $controller
     */
    protected function setController($controller)
    {
        $this->_controller = $controller;
    }

    /**
     * Возвращает экшен роута
     * @return mixed
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * Устанавливает экшен для роута
     * @param mixed $action
     */
    protected function setAction($action)
    {
        $this->_action = $action;
    }

    /**
     * Возвращает тип обрабатываемого запроса роутом
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Устанавливает тип обрабатываемого запроса роутом
     * @param string $type
     */
    protected function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * Возвращает правила валидации для роута
     * @return mixed
     */
    public function getRules()
    {
        return $this->_rules;
    }

    /**
     * Устанавливает правила валидации для роута
     * @param mixed $rules
     */
    protected function setRules($rules)
    {
        $this->_rules = $rules;
    }

    /**
     * Возвращает имя роута
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Устанавливает имя роута
     * @param mixed $name
     */
    protected function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Инициализация роута
     * @param $params
     * @return $this
     * @throws Exception
     */
    public function init($params,$type){
        if($this->_name !== null){
            throw new \Exception('You can\'t change isset route params');
        }

        $this->setName($params[0]['as']);
        $this->setUri(($params[0][0] != '/') ? ($params[0][0]) : '/');
//var_dump($this->_uri);
        $routeFuncs = explode('@',$params[1]);
        $this->setController($routeFuncs[0]);
        $this->setAction($routeFuncs[1]);
        $this->setType($type);
        if(!empty($params[0]['rules'])){
            $this->setRules($params[0]['rules']);
        }

        return $this;
    }

    /**
     * Проверяет совпадает ли адрес роута с указанным
     * @param $uri
     * @return bool
     */
    public function matchURI($uri){

        if(class_exists('Lang')){
            $uri = Lang::instance()->initSiteLangFromUri(App::instance()->http()->getURI());
        }
        //проверяем верная ли оконцовка файла указанная в конфигах


//var_dump(preg_match('#\.html$#uD',$uri));die;
        if(! preg_match('#'.str_replace('.','\.',App::URI_EXT).'$#uD',$uri) && $uri != '/'){
            return empty($this->_rules) && ($this->_uri.App::URI_EXT === $uri);
        }
        //удаляем оконцовку
        $uri = preg_replace('#('.str_replace('.','\.',App::URI_EXT).')$#uD' ,'',$uri);
        $pattern = $this->_uri;
//var_dump($uri);echo '<pre>';
        //находим совпадения для правил валидации
        preg_match_all('#[{]([^}?]+)([?]?)[}]#uD',$pattern,$matches);
        //обрабатывает страку в соответствии с правилами валидации
        if(!empty($matches)){

            $patterns = $replacments = [];
            for($i = 0; $i < count($matches[1]); $i++){
                $endOfPattern = ')';
                if(isset($this->_rules[$matches[1][$i]])){
                    $endOfPattern = preg_replace('#\.#uD','[^/\#.\^$]',$this->_rules[$matches[1][$i]]).$endOfPattern;
                }else{
                    $endOfPattern = '[^/\#.\^$]+'.$endOfPattern;
                }
                if($matches[2][$i] === '?'){
                    $endOfPattern .= '?';
                }
                $replacments[$matches[1][$i]] = '(?P<'.$matches[1][$i].'>'.$endOfPattern;
                $patterns[] = '#[{]'.$matches[1][$i].'[?]?[}]#uD';
            }
            $pattern = preg_replace($patterns,$replacments,$pattern);
//var_dump($pattern);echo '<pre>';

            if(preg_match('#[/]\([^)]+\)[?]#uD',$pattern)){
                $pattern = preg_replace('#([/])(\([^)]+\))([?])#uD','(?(?=/)(/$2))?',$pattern);
            }
        }
//var_dump($pattern);echo '<pre>';

        // Lang
//var_dump($uri);

//preg_match("#^\/ru(\/|\b)#uD", $uri, $lang_iso); echo "<pre>";
//print_r($lang_iso);

        $match = (bool) preg_match("#^$pattern$#uD",$uri,$this->_actionVaribles);
//var_dump($this->_actionVaribles);echo '<pre>';

        //отправляем переданные переманные в контроллер
        foreach($this->_actionVaribles as $key => $val)
            if(is_numeric($key)) unset($this->_actionVaribles[$key]);
//var_dump($this->_actionVaribles);echo '<pre>';

        return $match;

    }

    /**
     * Исполняет работу роута
     */
    public function execute(){
        $this->validateRequest();
        $class = $this->_controller;

        $method = $this->_action;
        $response = new $class($this->_actionVaribles ?: []);

        ob_start();
        $response->{$method}();
        App::instance()->http()->fireHeaders();
       return  ob_get_clean();

    }

    /**
     * Валидация типа запроса
     * @return bool
     */
    protected function validateRequest(){
        return ($this->_type == "any" || $this->_type === App::instance()->http()->getRequestType());
    }

    /**
     * Определяет является ли запрос валидным для ткущего роута
     * @return bool
     */
    public function requestIsValid(){
        return $this->validateRequest();
    }


}
