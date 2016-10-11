<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отабражения элементов страницы
 * по средствам его методов
 */

namespace Widgets\Widget;
restrictAccess();


use Widgets\AbstractWidget;
use View;
use PhotoGalleryModel;
use Router;
use Event;

class PhotoGalleriesPage extends AbstractWidget{

    /**
     * Тип страницы
     */
    protected $_type;

    /**
     * Позиция
     */
    protected $_position;

    /**
     * Индекс сортировки
     */
    protected $_sort;

    /**
     * Шаблон
     */
    protected $_template;

    /**
     * Параметри в виде JSON-а
     */
    protected $_param;

    /**
     * Галерий
     * @type array[PhotoGalleryModel]
     */
    protected $_items = [];


    public function getPosition()
    {
        return $this->_position;
    }

    public function getSorting()
    {
        return $this->_sort;
    }

    public function render()
    {
        return View::make($this->_template)
            ->with('items', $this->_items);
    }

    // todo:: avelacnel Pegination
    public function init($model)
    {
//        $param = Router::getCurrentRoute()->getActionVariable('param');

        $this->_items = PhotoGalleryModel::all();
//
//        if( ! $data) Event::fire('App.invalidRoute', Router::getCurrentRoute());
//
//        $this->_items = $data->photos()->get()->toArray();
//
//        $this->_items = array_chunk($this->_items, 8, true);

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_param = $model->param;
        $this->_type = $model->type;
    }
}