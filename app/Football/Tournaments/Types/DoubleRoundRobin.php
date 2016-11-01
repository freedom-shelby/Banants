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
use View;

class DoubleRoundRobin extends AbstractType {

    const WIN_POINT = 3;
    const DRAW_POINT = 1;
    const LOSE_POINT = 0;
    

    /**
     * Конструктор
     * @param $model
     */
    public function __construct($model){
        $this->init($model);
    }

    /**
     * Фабричный метод
     * @param $model Eloquent
     * @return DoubleRoundRobin $item
     */
    public static function factory($model)
    {
        $item = new self($model);
        return $item;
    }

    public function getTeams()
    {
        return $this->_teams->orderBy('pos')->get()->keyBy('id');
    }

    public function getLazyModelForTeams()
    {
        return $this->_teamModels->with('entity')->orderBy('pos')->get()->keyBy('id');
    }

    public function loadFromArray(array $data)
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

    /**
     * Оптимизирует таблицу по текущей статистке (не трогает позиций)
     */
    public function autoOptimizeTable()
    {
        $this->loadFromArray($this->getTeams()->toArray());
    }

    /**
     * Генерирует Таблицу с нуля (по статистике всех сыгранных играх)
     */
    public function generateTable()
    {
        // todo:: $this->generateWithRoundEvents()

        $this->loadFromArray($this->getTeams()->toArray());

        $this->sortPositions();
    }

    public function renderBasicWidget()
    {
        return View::make('front/content/football/tournaments/basic')
            ->with('items', $this->getTeams());
    }

    public function sortPositions()
    {
        $teams = $this->getTeams()->toArray();

        usort($teams, [$this, 'bestOfBothTeam']);

echo "<pre>";
print_r($teams);
die;
//        Arr::array_order_by($data,
//            'points', SORT_DESC, SORT_NUMERIC,
//            'duels', SORT_ASC, SORT_NUMERIC,
//            'difference', SORT_ASC, SORT_NUMERIC,
//            'goals_for', SORT_ASC, SORT_NUMERIC);

//        foreach ($data as $key => $value) {
//            $optimized = $this->optimizeTeamStatistic($value);
//            $this->getTeams()->find($key)->update($optimized);
//        }
    }

    /**
     * Возвращает Какая команда лучший по всем параметрам
     * @param $team1
     * @param $team2
     *
     * @return int (-1 => <) (0 => ==) (+1 => >)
     */
    public function bestOfBothTeam($team1, $team2)
    {
        if($team1['points'] == $team2['points'])
        {
            if($cmp = $this->whoWonOnDuel($team1, $team2))
            {
                if($team1['win'] == $team2['win'])
                {
                    if($team1['difference'] == $team2['difference'])
                    {
                        if($team1['goals_against'] == $team2['goals_against'])
                        {
                            return 0;
                        }

                        return $team1['goals_against'] - $team2['goals_against'];
                    }

                    return $team1['difference'] - $team2['difference'];
                }

                return $team1['win'] - $team2['win'];
            }

            return $cmp;
        }

        return $team1['points'] > $team2['points'] ? -1 : 1;
    }

    public function whoWon()
    {
        // todo::
    }

    /**
     * Возвращает Какая команда победила в матчах между собой в текущем турнире
     * @return int
     */
    public function whoWonOnDuel($team1, $team2)
    {
//        $t1 = $this->getEvents()->whereHome_team_id($team1['team_id'])->whereAway_team_id($team2['team_id'])->get();
        $t1 = $this->getEvents()->whereHome_team_id($team1['team_id'])->whereAway_team_id($team2['team_id'])->get();

        echo "<pre>";
        print_r($t1->toArray());
        die;
        
        if($team1['goals_against'] == $team2['goals_against'])
        {
            return 0;
        }

        return $team1['goals_against'] - $team2['goals_against'];
    }

    // todo:: Add match and generateTable()
} 