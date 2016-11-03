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
use EventModel;

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
        $teams = $this->generateTeamsStatistics();

        $this->loadFromArray($teams);
//        $this->loadFromArray($this->getTeams()->toArray());

        $this->sortPositions();
    }

    public function renderBasicWidget()
    {
        return View::make('front/content/football/tournaments/basic')
            ->with('items', $this->getTeams());
    }

    /**
     * Сортирует позииций клубов
     */
    public function sortPositions()
    {
        $teams = $this->getTeams()->toArray();

        usort($teams, [$this, 'bestOfBothTeam']);
        
//        Arr::array_order_by($teams,
//            'points', SORT_DESC, SORT_NUMERIC,
//            'win', SORT_DESC, SORT_NUMERIC,
//            'difference', SORT_ASC, SORT_NUMERIC,
//            'goals_for', SORT_ASC, SORT_NUMERIC);

        foreach ($teams as $key => $value) {
            $this->getTeams()->find($value['id'])->update(['pos' => ++$key]); // Обновляет позиции команд добавляя 1 к индексу массива по скольку индекс начинается с 0
        }
    }

    /**
     * Возвращает Какая команда лучший по всем параметрам
     * @param $team1
     * @param $team2
     *
     * @return int (- => <) (0 => ==) (+ => >)
     * Если возврошает положителное число(+) то team2 силнее чем team1
     * Значит в функций usort() team1 > team2 и по этому сортировка начинается с team2 (значит с сильных и по убиванию)
     */
    public function bestOfBothTeam($team1, $team2)
    {
        if($team1['points'] == $team2['points'])
        {
            $cmp = $this->whoWonOnDuel($team1, $team2);

            if($cmp === 0)
            {
                if($team1['win'] == $team2['win'])
                {
                    if($team1['difference'] == $team2['difference'])
                    {
                        if($team1['goals_against'] == $team2['goals_against'])
                        {
                            return 0;
                        }

                        return $team2['goals_against'] - $team1['goals_against'];
                    }

                    return $team2['difference'] - $team1['difference'];
                }

                return $team2['win'] - $team1['win'];
            }

            return $cmp;
        }

        return $team2['points'] - $team1['points']; // Если + то у team2 больше очков чем у team1
    }

    /**
     * Возвращает Какая команда победила в матчах между собой в текущем турнире
     *
     * Возвращает 0 если общий счёт равный
     * 
     * @param $team1
     * @param $team2
     * @return int
     */
    public function whoWonOnDuel($team1, $team2)
    {
        $goals['team1'] = 0;
        $goals['team2'] = 0;

        $model = $this->getEvents()
            ->where(['home_team_id' => $team1['team_id'], 'away_team_id' => $team2['team_id']])
            ->orWhere(['home_team_id' => $team2['team_id'], 'away_team_id' => $team1['team_id']])
            ->with('homeModel')
            ->with('awayModel')
            ->get()
            ->toArray();

        // Считает забитые голы команд
        foreach($model as $item) {
            if($item['home_team_id'] == $team1['team_id'])
            {
                $goals['team1'] += $item['home_model']['score'];
                $goals['team2'] += $item['away_model']['score'] * (1 + static::GOAL_FACTOR); // Для голах забытых в гостях Добавляет коэффициент
            }else{
                $goals['team2'] += $item['home_model']['score'];
                $goals['team1'] += $item['away_model']['score'] * (1 + static::GOAL_FACTOR); // Для голах забытых в гостях Добавляет коэффициент
            }
        }

        if($goals['team1'] == $goals['team2'])
        {
            return 0;
        }

        return $goals['team2'] - $goals['team1'];
    }

    /**
     * Генерирует статистику команд по раундам сыгранных игр
     * @return array
     */
    public function generateTeamsStatistics()
    {
        $events = $this->getEvents()
            ->with('homeModel')
            ->with('awayModel')
            ->get()
            ->toArray();

        $teams = [];

        $teamsStatistic = $this->_teams->get()->keyBy('team_id')->toArray();
        
        foreach ($events as $event)
        {
            $homeId = $teamsStatistic[$event['home_team_id']]['id'];
            $awayId = $teamsStatistic[$event['away_team_id']]['id'];

            // Инициализация
            if( ! isset($teams[$homeId]['goals_for'])) $teams[$homeId]['goals_for'] = 0;
            if( ! isset($teams[$homeId]['goals_against'])) $teams[$homeId]['goals_against'] = 0;
            if( ! isset($teams[$homeId]['win'])) $teams[$homeId]['win'] = 0;
            if( ! isset($teams[$homeId]['draw'])) $teams[$homeId]['draw'] = 0;
            if( ! isset($teams[$homeId]['lose'])) $teams[$homeId]['lose'] = 0;
            if( ! isset($teams[$awayId]['goals_for'])) $teams[$awayId]['goals_for'] = 0;
            if( ! isset($teams[$awayId]['goals_against'])) $teams[$awayId]['goals_against'] = 0;
            if( ! isset($teams[$awayId]['win'])) $teams[$awayId]['win'] = 0;
            if( ! isset($teams[$awayId]['draw'])) $teams[$awayId]['draw'] = 0;
            if( ! isset($teams[$awayId]['lose'])) $teams[$awayId]['lose'] = 0;

            // Забитие голи
            $homeScores = $event['home_model']['score'];
            $awayScores = $event['away_model']['score'];
            
            $teams[$homeId]['goals_for'] += $homeScores;
            $teams[$awayId]['goals_against'] += $homeScores;
            $teams[$awayId]['goals_for'] += $awayScores;
            $teams[$homeId]['goals_against'] += $awayScores;
            
            $result = $this->whoWon($event);

            switch($result)
            {
                case static::EVENT_DRAW:
                    $teams[$homeId]['draw']++;
                    $teams[$awayId]['draw']++;
                    $status = static::EVENT_STATUS_COMPLETED;
                    break;

                case static::EVENT_HOME_WIN:
                    $teams[$homeId]['win']++;
                    $teams[$awayId]['lose']++;
                    $status = static::EVENT_STATUS_COMPLETED;
                    break;

                case static::EVENT_AWAY_WIN:
                    $teams[$homeId]['lose']++;
                    $teams[$awayId]['win']++;
                    $status = static::EVENT_STATUS_COMPLETED;
                    break;

                case static::EVENT_PENDING:
                    $status = static::EVENT_PENDING;
                    break;

                default:
                    $status = static::EVENT_PENDING;
            }

            // Обновляет статус собития
            EventModel::find($event['id'])->update(['winner' => $result, 'status' => $status]);
        }

        return $teams;
    }

    /**
     * Определяет какая команда победила
     * @param $event array|Eloquent
     * @return int
     */
    public function whoWon($event)
    {
        if(is_array($event))
        {
            $homeScores = $event['home_model']['score'];
            $awayScores = $event['away_model']['score'];

            // Если счёт NULL то игра еще не началась
            if(($homeScores === null) and ($awayScores === null)) return static::EVENT_PENDING;

            // Если счёт равно то ничейний резултат
            if($homeScores == $awayScores) return static::EVENT_DRAW;

            return ($homeScores > $awayScores) ? static::EVENT_HOME_WIN : static::EVENT_AWAY_WIN;
        }
        // todo:: Eloquent Event
    }
    // todo:: Add match and generateTable()
} 