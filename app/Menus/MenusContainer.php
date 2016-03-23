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

    const MENU_NAMESPACE = 'Menus\Menu\\';

    /**
     * Активние Виджеты
     * @var array
     */
    protected $_items = [];

    protected $_active;

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

        $slug = Router::getCurrentRoute()->getActionVariable('page') ?: 'home';

        $cache = new Cache();
        $cache->setLocalPath($slug.'_menus');
        $cache->load();
        if($cache->isValid()){
            $items = json_decode($cache->getData());
        }else{
            $items = MenuModel::all();

            if(empty($items)){
                throw new HttpException(404);
            }
            $items = $items->menus()->whereStatus(1)->get();

            $cache->setData($items);
            $cache->save();
        }

        if(!empty($items)){
            foreach($items as $i){
                $class = static::MENU_NAMESPACE . $i->type;
                $tmp = (new $class);
                $tmp->init($i);
                // todo: в админке проверять чтобы Sorting биль уникалним
                $this->_items[$tmp->getPosition()][$tmp->getSorting()] = $tmp;
            }
        }
    }

    public function isActive($slug)
    {
        return ($slug == $this->_active);
    }

    /**
     * Рисует меню по позиций
     * $position = ['left','right']
     * @param string $position
     * @return View
     */
    public function draw($position)
    {
        $content = '';
        if( ! empty($this->_items[$position])){
            foreach($this->_items[$position] as $item){
                $content .= $item->render() . PHP_EOL;
            }
        }

        return $content;
    }
}