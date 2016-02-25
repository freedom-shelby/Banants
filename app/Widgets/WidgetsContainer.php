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
     * @return WidgetsContainer
     */
    public static function instance(){

        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){
        $items = \LangModel::where('is_enabled', '=', '1')->get();


        if(!empty($items)){
            foreach($items as $i){
                $iso = strtolower($i->iso);
                $this->_items[$iso] = array(
                    'id' => $i->id,
                    'name' => $i->name,
                    'iso' => $iso,
                );
            }
        }

        $this->_currentLang = $this->_primaryLang;
    }
    /**
     * Рисует виджеты для позиици
     * @param string $position
     */
    public function draw($position)
    {

    }
}