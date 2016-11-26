<?php

namespace Lang;
restrictAccess();

use Setting;
use Cache\LocalStorage as Cache;
use LangModel;

class Lang {

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
     * @return Lang
     */
    public static function instance(){

        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){
        $cache = new Cache();
        $cache->setLocalPath('languages');
        $cache->load();
        if($cache->isValid()){
            $items = json_decode($cache->getData());
        }else{
            $items = LangModel::where('status', '=', '1')->get();

            $cache->setData($items);
            $cache->save();
        }

        // Устанавливает язык по умолчанию
        if(class_exists('Setting')){
            $primaryLangIso = strtolower(Setting::instance()->getSettingVal('language.primary_language'));
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
                    'iso3' => $i->iso3,
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
    public function getCurrentLangExcept($langIso)
    {
        if(is_array($langIso)){
            if(array_key_exists($this->_currentLang['iso'], $langIso)){
                return false;
            }
        }else{
            if($langIso == $this->_currentLang['iso']){
                return false;
            }
        }

        return $this->_currentLang;
    }


    public function getLangsExcept($langIso)
    {
        $tmp = $this->_langs;
        if(isset($tmp[$langIso])){
            unset($tmp[$langIso]);
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
        return ($langIso == $this->getPrimaryLang()['iso']) ?: false;
    }

}