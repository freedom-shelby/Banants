<?php

class Langs {

    const DEFAULT_LANGUAGE = 'en';
    protected $_currentLang;
    protected $_primaryLang;

    protected static $_instance;

    /**
     * Список доступних языков
     * @var array
     */
    protected $_langs = array();

    /**
     * Возвращает объект корзины
     * @return Langs
     */
    public static function instance(){

        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){
        $items = \LangModel::where('is_enabled', '=', '1')->get();
        if(class_exists('Setting') and method_exists(Setting::instance(), 'get_setting_val')){
            $primaryLangIso = strtolower(Setting::instance()->get_setting_val('language.primary_language'));
        }else{
            $primaryLangIso = strtolower(static::DEFAULT_LANGUAGE);
        }

        if(!empty($items)){
            foreach($items as $i){
                $iso = strtolower($i->iso);
                $this->_langs[$iso] = array(
                    'id' => $i->id,
                    'name' => $i->name,
                    'iso' => $iso,
                );

                if($primaryLangIso == $i->iso){
                    $this->_primaryLang = $this->_langs[$iso];
                }
            }
        }

        $this->_currentLang = $this->_primaryLang;

    }

    /**
     * Инициализирует язык по заданнуму УРИ
     * Возврошает УРИ с обрезанныйм ИСО
     * @param $uri
     * @return mixed
     */
    public function initSiteLangFromUri($uri)
    {
        preg_match('#^\/[a-z]{2}(\/|\b)#uD', $uri, $lang_iso);
//print_r('<pre>');
//print_r($uri);
//print_r($this->_primaryLang);die;
        if(!empty($lang_iso)){
            $iso = str_replace('/', '', $lang_iso[0]);
            if(array_key_exists($iso, $this->_langs) and $iso != $this->_primaryLang['iso']){

                // Вырезает из строки первое вхождения исо языка (самий бистрий способ;))
                $pos = strpos($uri, $lang_iso[0]);
                if ($pos !== false) {
                    $uri = substr_replace($uri, '/', $pos, strlen($lang_iso[0])); // Вырезает исо
                }

                $this->setCurrentLang($iso);
            }
        }
//print_r('<pre>');
//print_r($uri);die;
        return $uri;

    }

    /**
     * @return mixed
     */
    public function getCurrentLang()
    {
        return $this->_currentLang;
    }

    /**
     * @return mixed
     */
    public function getCurrentLangExcept($langs_iso)
    {
        if(is_array($langs_iso)){
            if(array_key_exists($this->_currentLang['iso'], $langs_iso)){
                return false;
            }
        }else{
            if($langs_iso == $this->_currentLang['iso']){
                return false;
            }
        }

        return $this->_currentLang;
    }


    public function getLangsExcept($lang_iso)
    {
        $tmp = $this->_langs;
        if(isset($tmp[$lang_iso])){
            unset($tmp[$lang_iso]);
        }

        return $tmp;
    }


    /**
     * @param mixed $langIso
     */
    public function setCurrentLang($langIso = null)
    {
        $langIso = strtolower($langIso);
        if(isset($this->_langs[$langIso])){
            $this->_currentLang = $this->_langs[$langIso];
        }else{
            $this->_currentLang = $this->_primaryLang;
        }
    }

    public function getPrimaryLang()
    {
        return $this->_primaryLang;
    }

    public function getLangs(){
        return $this->_langs;
    }

    public function getLang($iso){
        return $this->_langs[strtolower($iso)];
    }

    public function isPrimary($langIso)
    {
        $langIso = strtolower($langIso);
        return ($langIso == Langs::instance()->getPrimaryLang()['iso']) ?: false;
    }

}