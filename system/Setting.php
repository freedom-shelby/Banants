<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 14.10.14
 * Time: 13:40
 * Класс настроек приложения
 * Паттерн одиночка(Singleton)
 */

class Setting {

    public static $_instance;

    protected $_items;

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
    public function get_all_groups(){
        return \SettingsModel::all();
    }

    /**
     * Возвращает группу настроек
     * @param string $group_name имя группы
     * @return array|null
     */
    public function get_group($group_name){
        return isset($this->_items[$group_name]) ? $this->_items[$group_name] : null;
    }

    /**
     * Возвращает группу настроек в виде ассоциативного массива
     * ключ => значение
     * @param string $group_name имя группы
     * @return array
     */
    public function get_group_as_key_val($group_name){
        $output = array();
        $group = $this->get_group($group_name);
        if(!empty($group)){
            foreach($group as $g){
                $output[$g['name']] = $g['value'];
            }
        }

        return $output;
    }

    /**
     * Возвращает конкретную настройку
     * Разрешается точеная нотация например
     * до настройки setting_name array([group][setting_name] => array())
     * можно достучаться через точку get_setting("group.setting_name")
     * @param $setting_name
     * @return mixed
     * @throws Exception
     */
    public function get_setting($setting_name){
        //если есть точка, то хотим достучаться до элементы конкретной группы
        if(strpos($setting_name,'.') !== FALSE){
            $args = explode('.',$setting_name);
            if(count($args) != 2){
                throw new Exception('When use dot notation for getting setting, you must have dot arrounded with two aplhanum pices from right and left');
            }
            if(isset($this->_items[$args[0]]) AND isset($this->_items[$args[0]][$args[1]])){
                return $this->_items[$args[0]][$args[1]];
            }
        }else{
            foreach($this->_items as $key => $val){
                if($val['name'] == $setting_name){
                    return $val['name'];
                }
            }
        }
    }

    /**
     * Возвращает определённый параметр из настройки
     * @param $setting_name
     * @param $param
     */
    public function get_setting_param($setting_name,$param){
        $output = null;
        $setting = $this->get_setting($setting_name);
        if(!empty($setting) AND isset($setting[$param])){
            return $setting[$param];
        }
    }

    /**
     * Возвращает значение настройки
     * @param $setting_name
     * @return mixed
     */
    public function get_setting_val($setting_name){
        return $this->get_setting_param($setting_name,'value');
    }

    /**
     * Конструктор
     */
    protected function __construct(){

        $items = \SettingsModel::all();
        if(!empty($items)){
            foreach($items as $i){
                $this->_items[$i->group][$i->name] = array(
                   'id' => $i->id,
                   'name' => $i->name,
                   'value' => $i->value,
                   'title' => $i->title,
                   'desc' => $i->desc,
                ) ;
            }
        }
    }
    protected function __sleep(){}
    protected function __clone(){}
    protected function __wakeup(){}
} 