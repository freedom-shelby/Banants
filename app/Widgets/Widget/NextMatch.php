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
use Setting;
use TournamentModel;
use EventModel;
use Football\Tournaments\Tournament;

class NextMatch extends AbstractWidget{

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
    protected $_item;


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
            ->with('item', $this->_item);
    }

    public function init($model)
    {
        $this->_item = EventModel::find(Setting::instance()->getSettingVal('football.current_event'));

//        Carbon::setLocale('ru');
//        setlocale(LC_TIME, 'ru');
        $dt = $this->_item->played_at;
//        var_dump($dt->format('jS \\of M h:i'));
//
//        echo $dt->formatLocalized('%d %b');
//die;

        $time = __(':month :day', [
            ':month' => __($dt->format('M')),
            ':day' => $dt->format('j'),
            ]);

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_param = $model->param;
        $this->_type = $model->type;
    }
}