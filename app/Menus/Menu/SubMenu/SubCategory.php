<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отабражения элементов страницы
 * по средствам его методов
 */

namespace Menus\Menu\SubMenu;
restrictAccess();


use Menus\Menu\Category;
use Menus\MenusContainer;
use App;
use Helpers\Uri;

class SubCategory extends Category{

    /**
     * Позиция
     */
    protected $_position;

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

    public function setPosition($pos)
    {
        $this->_position = $pos;
    }

    public function render()
    {
        $output = '<div id="accordion" class="left_bar_menu">
                        <ul>';

        foreach($this->_items as $item){
            $output .= '<li ' . (($this->_active == $item->slug) ? 'class="active"' : "") . '><a href="' . Uri::makeUriFromId($item->slug) . '">' . __($item->text()) . '</a></li>';

            if(isset($item->children)) {
                $output .= $this->subMenuRender($item->children);
            }
        }

        $output .=    '</ul>
                  </div>';

        return $output . PHP_EOL;
    }

    public function subMenuRender($items)
    {
        $output = '<ul class="accordion-submenu">';

        foreach($items as $item)
        {
            $output .= '<li ' . (($this->_active == $item->slug) ? 'class="active"' : "") . '><a href="' . $item->slug.App::URI_EXT . '">' . __($item->text()) . '</a></li>';
        }

        $output .= '</ul>';

        return $output;
    }

    public function init($model)
    {
        $this->_items = $model->descendants()->whereStatus(1)->get()->toHierarchy();
        // Устанавлиает Активни пункт и суб-меню
        $this->_active = MenusContainer::getCurrent();
    }
}