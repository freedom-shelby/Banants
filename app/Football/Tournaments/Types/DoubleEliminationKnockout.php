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


class DoubleEliminationKnockout extends AbstractType {

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
     * @return self $item
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

    /**
     * Возврошает стадию финала
     * @return string
     */
    public function getRoundStage()
    {
        $stage = 1;

        $ratio = $this->getMaxRounds() - $this->getCurrentRound();

        $name = '';

        // Если это не финал
        if($ratio > 0)
        {
            // Рачёт начинаетца с конца (с финала)
            while($ratio > 0)
            {
                $ratio -= 2; // Уменшается 2 (игры дом-в гостях)
                $stage *= 2;
            }

            $name = '1/' . $stage;
        }

        return $name;
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
        $value['difference'] = $this->calculateDifference($goalsFor, $goalsAgainst);

        return $value;
    }

    public function calculatePlayedMatches($win = 0, $draw = 0, $lose = 0)
    {
        return (int) $win + $draw + $lose;
    }

    public function calculateDifference($goalsFor, $goalsAgainst)
    {
        return (int) ($goalsFor - $goalsAgainst);
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
     * Определяет какая команда победила
     * @param $event array|Eloquent
     * @return int
     * todo:: avelacnel Penalnern u Avelacra& jhamanak@ (voc-voqii depqum)
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

            return $cmp;
        }

        return $team2['points'] - $team1['points']; // Если + то у team2 больше очков чем у team1
    }

    /**
     * Генерирует Таблицу с нуля (по статистике всех сыгранных играх)
     */
    public function generateTable()
    {
        $teams = $this->generateTeamsStatistics();

        $this->loadFromArray($teams);

        $this->sortPositions();

        $this->generateCurrentEvent();
    }
} 