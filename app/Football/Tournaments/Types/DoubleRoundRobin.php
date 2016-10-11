<?php
/**
 * User: Arsen
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отабражения элементов страницы
 * по средствам его методов
 */

namespace Football\Tournaments\Types;
restrictAccess();

use Illuminate\Database\Eloquent\Model as Eloquent;
use Helpers\Arr;

class DoubleRoundRobin extends AbstractType {

    const WIN_POINT = 3;
    const DRAW_POINT = 1;
    const LOSE_POINT = 0;

    public function getPosition(){}
    public function getSorting(){}
    public function render(){}


    /**
     * Конструктор
     * @param $model
     * @param $id
     * @param $teams
     * @param $type
     * @param $current_round
     * @param $max_rounds
     */
    public function __construct($model,$id,$type,$teams,$current_round,$max_rounds){
        $this->_model = $model;
        $this->_id = $id;
        $this->_type = $type;
        $this->_teams = $teams;
        $this->_current_round = $current_round;
        $this->_max_rounds = $max_rounds;
    }

    /**
     * Фабричный метод
     * @param $model Eloquent
     * @return DoubleRoundRobin $item
     */
    public static function factory($model){

        $item = new self($model,$model->id,$model->type(),$model->tableTeams(),$model->current_round,$model->max_rounds);
        return $item;
    }


    public function getTeams()
    {
        return $this->_teams->orderBy('pos')->get()->keyBy('id');
    }

    public function loadFromArray($data)
    {
        foreach ($data as $key => $value) {
            $optimized = $this->optimizeTeamStatistic($value);
            $this->getTeams()->find($key)->update($optimized);
        }

        return $this;
    }

    /**
     * Считает очки и количество сыгранийх матчей
     * @param array $value['win','draw','lose']
     * @return array mixed
     */
    public function optimizeTeamStatistic(array $value)
    {
        $win = Arr::get($value, 'win');
        $draw = Arr::get($value, 'draw');
        $lose = Arr::get($value, 'lose');
        $goalsFor = Arr::get($value, 'goals_for');
        $goalsAgainst = Arr::get($value, 'goals_against');

        $value['played'] = $this->calculatePlayedMatches($win, $draw, $lose);
        $value['points'] = $this->calculatePoints($win, $draw, $lose);
        $value['difference'] = $this->calculateDifference($goalsFor, $goalsAgainst);

        return $value;
    }

    public function calculatePlayedMatches($win = 0, $draw = 0, $lose = 0)
    {
        return (int) $win + $draw + $lose;
    }

    public function calculatePoints($win = 0, $draw = 0, $lose = 0)
    {
        return (int) (static::WIN_POINT * $win) + (static::DRAW_POINT * $draw) + (static::LOSE_POINT * $lose);
    }

    public function calculateDifference($goalsFor, $goalsAgainst)
    {
        return (int) ($goalsFor - $goalsAgainst);
    }

    public function generateTable()
    {
        $this->loadFromArray($this->getTeams()->toArray());

        $this->sortPositions();// todo:: generate table positions

//        foreach ($data as $key => $value) {
//            $optimized = $this->optimizeTeamStatistic($value);
//            $this->getTeams()->find($key)->update($optimized);
//        }
    }

    public function sortPositions()
    {
     // todo:: generate table positions

//        foreach ($data as $key => $value) {
//            $optimized = $this->optimizeTeamStatistic($value);
//            $this->getTeams()->find($key)->update($optimized);
//        }
    }

    public function whoWon()
    {
        // todo::
    }

    // todo:: Add match and generateTable()
} 