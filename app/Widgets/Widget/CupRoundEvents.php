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
use Setting;
use Football\Tournaments\Tournament;
use TournamentModel;
use Event;


class CupRoundEvents extends AbstractWidget{

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
     * Собития Турнамента
     * @type \EventModel
     */
    protected $_items = [];

    /**
     * @var Tournament
     */
    protected $_tournament;

    /**
     * Прошедщий Тур
     * @var
     */
    protected $_round;

    /**
     * Имя Тур
     * @var
     */
    protected $_roundStage;

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
            ->with('roundStage', $this->_roundStage)
            ->with('items', $this->_items);
    }

    public function init($model)
    {
        $slug = Setting::instance()->getSettingVal('football.armenian_cup');
        $tournamentModel = TournamentModel::whereSlug($slug)->first();

        if ( ! $tournamentModel){
            Event::fire('App.invalidRoute',$slug);
        }

        $this->_tournament = Tournament::factory($tournamentModel);

        $this->_round = $this->_tournament->getCurrentRound();
        $this->_roundStage = $this->_tournament->getRoundStage();
        $this->_items = $this->_tournament->getEventsByRound($this->_round);

        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_param = $model->param;
        $this->_type = $model->type;
    }
}