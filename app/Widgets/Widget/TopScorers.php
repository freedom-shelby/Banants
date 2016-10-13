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


use Football\Tournaments\Tournament;
use Widgets\AbstractWidget;
use View;
use TournamentModel;

class TopScorers extends AbstractWidget{

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
     * Матеряли
     * @type array[Tournament]
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

    public function init($model)
    {
        $this->_param = json_decode($model->param, true);

//        foreach ($this->_param['items'] as $item)
//        {
//            $tmp = TournamentModel::find($item);
//            $this->_items[] = Tournament::factory($tmp);
//
//            unset($tmp);
//        }

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_type = $model->type;
    }
}