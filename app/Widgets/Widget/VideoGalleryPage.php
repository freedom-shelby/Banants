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
use VideoModel;

class VideoGalleryPage extends AbstractWidget{

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
     * Видео
     * @type array(VideoModel)
     */
    protected $_items = [];

    /**
     * Максималний число INT в MySQL
     */
    const INT_MAX_VALUE = 2147483647;

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

    public function init($model)
    {
        $this->_param = json_decode($model->param, true);

        // Последние добавлённие видео начиная с второго
        $this->_items = VideoModel::orderBy('created_at', 'desc')->limit(static::INT_MAX_VALUE)->get()->toArray();

        $this->_items = array_chunk($this->_items, 8, true);
//echo "<pre>";
//print_r($this->_items);
//die;
        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_type = $model->type;
    }
}