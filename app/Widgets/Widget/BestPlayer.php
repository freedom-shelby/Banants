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
use EventModel;
use EventPlayerStatisticModel;
use Setting;

class BestPlayer extends AbstractWidget{

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
    protected $_title;
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
            ->with('item', $this->_item)
            ->with('title', $this->_title);
    }

    public function init($model)
    {
        $lastEvent = EventModel::find(Setting::instance()->getSettingVal('football.last_event'));
        $playerId = Setting::instance()->getSettingVal('football.best_player');

        $this->_title = __($lastEvent->homeTeam()->shortName()) .' - '.
            __($lastEvent->awayTeam()->shortName()) .'. '.
            __('BEST PLAYER');
        
        $this->_item = $lastEvent->playersStatistics()->wherePlayer_id($playerId)->first();

        /**
         * Если нету текющего лучшего игрока то получить последного доступного игрока
         */
        if(! $this->_item){
            $lastBestPlayer = EventPlayerStatisticModel::wherePlayer_id($playerId)->orderBy('id', 'DESC')->first();

            $this->_title = __($lastBestPlayer->event()->homeTeam()->shortName()) .' - '.
                __($lastBestPlayer->event()->awayTeam()->shortName()) .'. '.
                __('BEST PLAYER');

            $this->_item = $lastBestPlayer;
        }

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_param = $model->param;
        $this->_type = $model->type;
    }
}