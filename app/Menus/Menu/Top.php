<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отабражения элементов страницы
 * по средствам его методов
 */

namespace Menus\Menu;
restrictAccess();


use Menus\AbstractMenu;
use App;
use Helpers\Uri;

class Top extends AbstractMenu{

    /**
     * Тип страницы
     */
    protected $_type;

    /**
     * Позиция
     */
    protected $_position;

    /**
     * Загаловок меню
     */
    protected $_title;

    /**
     * Шаблон
     */
    protected $_template;

    /**
     * Активний пункт
     * @var
     */
    protected $_active;

    /**
     * Пункти меню
     */
    protected $_items;


    public function getPosition()
    {
        return $this->_position;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function render()
    {
        $output = '<ul>';

        foreach($this->_items as $item){
            $output .= '<li><a class="icon clearfix" href="' . Uri::makeUriFromId($item->slug) . '"><span class="icon ' . $item->icon . '"></span><span class="icon_text">' . __($item->text()) . '</span></a></li>';
        }

        $output .= '</ul>';

        return $output . PHP_EOL;
    }

    public function init($model)
    {
        $this->_position = $model->pos;
        $this->_title = $model->title;

        $model = $model->items()->whereStatus(1);

        // Устанавлиает Активни пункт и суб меню
//        foreach($model->get() as $item)
//        {
//            if($item->_slug == MenusContainer::getCurrent()){
//                if($item->lvl == MenusContainer::CATEGORY_LEVEL){
//                    $this->initSubMenu($item);
//                    $this->_active = $item->_slug;
//                }else{
//                    $tmpModel = $item->ancestors()->whereLvl(MenusContainer::CATEGORY_LEVEL)->first();
//                    $this->initSubMenu($tmpModel);
//                    $this->_active = $tmpModel->_slug;
//                }
//            }
//        }

        $this->_items = $model->get()->toHierarchy();
    }

    public function initSubMenu($model)
    {
        $this->_position = $model->pos;
        $this->_title = $model->title;
        $this->_items = $model->items()->whereStatus(1);
    }
}