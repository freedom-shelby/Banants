<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отображения элементов страницы
 * по средствам его методов
 */
namespace Widgets;

class WidgetsContainer {

    /**
     * Активние Виджеты
     * @var array
     */
    protected $_items = [];

    protected static $_instance;


    /**
     * Возвращает объект виджета
     * @return Langs
     */
    public static function instance(){

        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){
//        $items = \LangModel::where('is_enabled', '=', '1')->get();
//        if(class_exists('Setting') and method_exists(Setting::instance(), 'get_setting_val')){
//            $primaryLangIso = strtolower(Setting::instance()->get_setting_val('language.primary_language'));
//        }else{
//            $primaryLangIso = strtolower(static::DEFAULT_LANGUAGE);
//        }
//
//        if(!empty($items)){
//            foreach($items as $i){
//                $iso = strtolower($i->iso);
//                $this->_langs[$iso] = array(
//                    'id' => $i->id,
//                    'name' => $i->name,
//                    'iso' => $iso,
//                );
//
//                if($primaryLangIso == $i->iso){
//                    $this->_primaryLang = $this->_langs[$iso];
//                }
//            }
//        }
//
//        $this->_currentLang = $this->_primaryLang;
    }

    /**
     * Рисует виджеты для позиици
     * @param string $position
     */
    public function draw($position)
    {

    }
}