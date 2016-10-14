<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 14.10.14
 * Time: 13:40
 * Класс настроек приложения
 * Паттерн одиночка(Singleton)
 */
restrictAccess();
use Cache\LocalStorage as Cache;


class Setting {

    public static $_instance;

    protected $_items = [];

    const MAX_CATEGORY_LEVEL = 2;

    /**
     * Точка доступа
     * @return Setting
     */
    public static function instance(){

        if(self::$_instance === null){
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Возвращает все группи настроек в виде обекта ORM
     * @return array|null
     */
    public function getAllGroups(){
        return \SettingsModel::all();
    }

    /**
     * Возвращает группу настроек
     * @param string $groupName имя группы
     * @return array|null
     */
    public function getGroup($groupName){
        return isset($this->_items[$groupName]) ? $this->_items[$groupName] : null;
    }

    /**
     * Возвращает группу настроек в виде ассоциативного массива
     * ключ => значение
     * @param string $groupName имя группы
     * @return array
     */
    public function getGroupAsKeyVal($groupName){
        $output = array();
        $group = $this->getGroup($groupName);
        if(!empty($group)){
            foreach($group as $g){
                $output[$g['name']] = $g['value'];
            }
        }

        return $output;
    }

    /**
     * Возвращает есть ли значения в настройке
     * @param string $groupName имя группы
     * @return bool
     */
    public function groupHasVal($groupName, $value){
        $output = false;
        $group = $this->getGroupAsKeyVal($groupName);

        if(!empty($group) and in_array($value, $group)){
            $output = true;
        }

        return $output;
    }

    /**
     * Возвращает конкретную настройку
     * Разрешается точеная нотация например
     * до настройки setting_name array([group][setting_name] => array())
     * можно достучаться через точку getSetting("group.setting_name")
     * @param $settingName
     * @return mixed
     * @throws Exception
     */
    public function getSetting($settingName){
        //если есть точка, то хотим достучаться до элементы конкретной группы
        if(strpos($settingName,'.') !== FALSE){
            $args = explode('.',$settingName);
            if(count($args) != 2){
                throw new Exception('When use dot notation for getting setting, you must have dot arrounded with two aplhanum pices from right and left');
            }
            if(isset($this->_items[$args[0]]) AND isset($this->_items[$args[0]][$args[1]])){
                return $this->_items[$args[0]][$args[1]];
            }
        }else{
            foreach($this->_items as $key => $val){
                if($val['name'] == $settingName){
                    return $val['name'];
                }
            }
        }
    }

    /**
     * Возвращает определённый параметр из настройки
     * @param $settingName
     * @param $param
     */
    public function getSettingParam($settingName,$param){
        $output = null;
        $setting = $this->getSetting($settingName);
        if(!empty($setting) AND isset($setting[$param])){
            return $setting[$param];
        }
    }

    /**
     * Возвращает значение настройки
     * @param $settingName
     * @return mixed
     */
    public function getSettingVal($settingName){
        return $this->getSettingParam($settingName,'value');
    }

    /**
     * Конструктор
     */
    protected function __construct(){

        // Кешировка данных
        $cache = new Cache();
        $cache->setLocalPath('settings');
        $cache->load();
        if($cache->isValid()){
            $this->_items = json_decode($cache->getData(), true);
        }else{
            $data = \SettingsModel::all();

            if(!empty($data)){
                foreach($data as $i){
                    $this->_items[$i->group][$i->name] = array(
                        'id' => $i->id,
                        'name' => $i->name,
                        'value' => $i->value,
                        'title' => $i->title,
                        'desc' => $i->desc,
                    ) ;
                }
            }

            $cache->setData(json_encode($this->_items));
            $cache->save();
        }

    }
    protected function __sleep(){}
    protected function __clone(){}
    protected function __wakeup(){}
} 