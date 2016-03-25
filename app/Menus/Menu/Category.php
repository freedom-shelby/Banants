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
use Menus\MenusContainer;
use View;

class Category extends AbstractMenu{

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

    /**
     * Пункти суб-меню
     */
    protected $_subMenuItems;


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
        // todo: Ндо добавить картинки к суб меню
//        '<div class="submenu_bottom clearfix">
//            <div class="submenu_bottom_col clearfix">
//                <a href="#">
//                    <div class="submenu_bottom_col_images pictures_wrapper">
//                        <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
//                    </div><!-- submenu_bottom_col_images -->
//                    <div class="submenu_bottom_col_info">
//                        <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
//                        <span>БАНАНЦ - ПЮНИК</span>
//                    </div><!-- /media/assets/images/menu_icon1.png_col_info -->
//                </a>
//            </div><!-- submenu_bottom_col -->
//            <div class="submenu_bottom_col clearfix">
//                <a href="#">
//                    <div class="submenu_bottom_col_images pictures_wrapper">
//                        <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
//                    </div><!-- submenu_bottom_col_images -->
//                    <div class="submenu_bottom_col_info">
//                        <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
//                        <span>БАНАНЦ - ПЮНИК</span>
//                    </div><!-- /media/assets/images/menu_icon1.png_col_info -->
//                </a>
//            </div><!-- submenu_bottom_col -->
//            <div class="submenu_bottom_col clearfix">
//                <a href="#">
//                    <div class="submenu_bottom_col_images pictures_wrapper">
//                        <img src="/media/assets/images/submenu_pic1.jpg" alt="submenu_pic1">
//                    </div><!-- submenu_bottom_col_images -->
//                    <div class="submenu_bottom_col_info">
//                        <h3>НЕВЕРОЯТНЫЙ<br> СЕЙВ<br> ВРАТАРЯ</h3>
//                        <span>БАНАНЦ - ПЮНИК</span>
//                    </div><!-- /media/assets/images/menu_icon1.png_col_info -->
//                </a>
//            </div><!-- submenu_bottom_col -->
//        </div><!-- submenu_bottom -->';

        $output = '<ul class="navigation_main clearfix" id="navigation_main">';

        // Иконка для Home
        $output .= '<li class="home"><a href="#"><img src="/media/assets/images/homeIcon.jpg" alt="homeIcon" /></a></li>';

        foreach($this->_items as $item){
            $output .= '<li class="submenu_parent"><a href="' . $item->slug . '">' . __($item->text()) . '</a>';

            if(isset($item->children)) {
                $output .= $this->subMenuRender($item->children);
            }

            $output .= '<li>';
        }

        $output .= '</ul>';

        return $output . PHP_EOL;
    }

    public function subMenuRender($items)
    {
        $output = '<ul class="submenu hidden">
                        <li>
                            <div class="submenu_top clearfix">';

        $i = 0;
        foreach($items as $item)
        {
            // Через каждий 3-ий пункт прикрепляет тег <ul>
            if(($i % 3) == 0){
                if($i != 0 ){
                    $output .= '</ul>';
                }
                $output .= '<ul>';
            }

            $output .= '<li><a href="' . $item->slug . '">' . __($item->text()) . '</a></li>';

            $i++;
        }

        $output .=        '</div>
                      </li>
                  </ul>';

        return $output;
    }

    public function init($model)
    {

        $this->_position = $model->pos;
        $this->_title = $model->title;

        $model = $model->items()->whereStatus(1);

        // Устанавлиает Активни пункт и суб-меню
        foreach($model->get() as $item)
        {
            if($item->slug == MenusContainer::getCurrent()){
                if($item->lvl == MenusContainer::CATEGORY_LEVEL){
                    $this->_active = $item->slug;
                    $this->initSubMenu($item);
                }else{
                    $tmpModel = $item->ancestors()->whereLvl(MenusContainer::CATEGORY_LEVEL)->first();
                    $this->_active = $tmpModel->slug;
                    $this->initSubMenu($tmpModel);
                }
            }
        }
        $this->_items = $model->get()->toHierarchy();
    }

    public function initSubMenu($model)
    {
//        $model->subMenus()->get()->toArray();
        $menus = $model->menu()->subMenus()->get();
        if(!empty($menus)){
            foreach($menus as $m){
                $class = AbstractMenu::SUB_MENU_NAMESPACE . $m->type;
                $tmp = (new $class);
                $tmp->init($model);
                $tmp->setPosition($m->pos);
                $this->_subMenuItems[$tmp->getPosition()] = $tmp;
            }
        }

//        echo "<pre>";
//        print_r($this->_subMenuItems);
//        die;

//        $this->_position = $model->pos;
//        $this->_title = $model->title;
//        $this->_items = $model->items()->whereStatus(1);
    }
}