<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отображения элементов страницы
 * по средствам его методов
 */
namespace Menus;
restrictAccess();


use Menus\Menu;
use MenuModel;
use View;
use Router;
use Http\Exception as HttpException;
use Cache\LocalStorage as Cache;


class MenusContainer {

    /**
     * Активние Пункти меню
     * @var array
     */
    protected $_items = [];

    const CATEGORY_LEVEL = 0;
    /**
     * Активние Пункти суб меню
     * @var array
     */
    protected $_subMenuItems = [];

    const MENU_NAMESPACE = 'Menus\Menu\\';

    protected $_current;

    protected static $_instance;

    /**
     * Возвращает объект виджета
     * @return MenusContainer
     */
    public static function instance(){

        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){

        $this->_current= Router::getCurrentRoute()->getActionVariable('page') ?: 'home';

        $cache = new Cache();
        $cache->setLocalPath($this->_current.'_menus');
        $cache->load();
        if($cache->isValid()){
            $this->_items = json_decode($cache->getData(), true);
        }else{
            $items = MenuModel::all();

            if(empty($items)){
                throw new HttpException(404);
            }

            if(!empty($items)){
                foreach($items as $i){
//                    echo "<pre>";
//                    print_r($i->pos);
//                    echo "<pre>";
//                    print_r($i->items()->whereStatus(1)->get()->toHierarchy()->toArray());

                    $class = static::MENU_NAMESPACE . $i->type;
                    var_dump($i->type);die;
                    $tmp = (new $class);
                    $tmp->init($i);
                    $this->_items[$tmp->getPosition()] = $tmp;
                }
//                $class = __NAMESPACE__ . '\\' . 'SubCategory';
//
//                $this->_items['sub_category'] = (new $class);
            }

//            $items = $items->menus()->whereStatus(1)->get();

//            if(!empty($items)){
//                foreach($items as $i){
//                    $class = static::MENU_NAMESPACE . $i->type;
//                    $tmp = (new $class);
//                    $tmp->init($i);
//                    // todo: в админке проверять чтобы Sorting биль уникалним
//                    $this->_items[$tmp->getPosition()][$tmp->getSorting()] = $tmp;
//                }
//            }

            $cache->setData(json_encode($this->_items));
            $cache->save();
        }


    }

    public function getCurrent()
    {
        return $this->_current;
    }


    public function isCurrent($slug)
    {
        return ($slug == $this->_current);
    }

    /**
     * Рисует меню по позиций
     * $position = ['top','bottom','category']
     * @param string $position
     * @return View
     */
    public function draw($position)
    {
        if( ! empty($this->_items[$position])){
            return $this->_items[$position]->render() . PHP_EOL;
        }
    }

    /**
     * Рисует суб меню по позиций
     * $position = ['sub_category']
     * @param string $position
     * @return View
     */
    public function drawSubMenu($position)
    {
        if( ! empty($this->_subMenuItems[$position])){
            return $this->_subMenuItems[$position]->render() . PHP_EOL;
        }
    }
}