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


use Football\Tournaments\Types\AbstractType;
use Widgets\AbstractWidget;
use View;
use EventModel;

class LastMatchesAnons extends AbstractWidget{

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
     * @var EventModel
     */
    protected $_items;


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
        $this->_items = (new EventModel)->getOwnTeamEventsWhereStatus(AbstractType::EVENT_STATUS_COMPLETED)
            ->orderBy('played_at', 'desc')
            ->limit(2)
            ->get();

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_param = $model->param;
        $this->_type = $model->type;
    }
}