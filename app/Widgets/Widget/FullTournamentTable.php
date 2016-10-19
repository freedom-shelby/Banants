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
use Helpers\Arr;
use Widgets\AbstractWidget;
use View;
use TournamentModel;
use Setting;
use Router;
use Event;

class FullTournamentTable extends AbstractWidget{

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
     * Турнамент
     * @type Tournament
     */
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
        $slug = Router::getCurrentRoute()->getActionVariable('param');

        // Проверяет Слуг для того чтобы страница турнамента не повторялся
        if( ! $slug)
        {
            $page = Router::getCurrentRoute()->getActionVariable('page');
            $slug = Arr::get(Setting::instance()->getGroupAsKeyVal('football'), $page);
        }elseif(Setting::instance()->groupHasVal('football', $slug))
        {
            Event::fire('App.invalidRoute',$slug);
        }

        $tournamentModel = TournamentModel::whereSlug($slug)->first();

        if ( ! $tournamentModel){
            Event::fire('App.invalidRoute',$slug);
        }

        $this->_item = Tournament::factory($tournamentModel);

        $this->_param = json_decode($model->param, true);
        $this->_position = $model->position;
        $this->_sort = $model->sort;
        $this->_template = $model->template;
        $this->_type = $model->type;
    }
}