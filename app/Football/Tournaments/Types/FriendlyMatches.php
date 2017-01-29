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


class FriendlyMatches extends AbstractType {

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
        return $this->_teams->get()->keyBy('id');
    }

    public function getLazyModelForTeams()
    {
        return $this->_teamModels->with('entity')->get()->keyBy('id');
    }

    public function loadFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $this->getTeams()->find($key)->update($value);
        }

        return $this;
    }

    /**
     * Генерирует Таблицу с нуля (по статистике всех сыгранных играх)
     */
    public function generateTable()
    {
        $teams = $this->generateTeamsStatistics();

        $this->loadFromArray($teams);

        $this->generateCurrentEvent();
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

        foreach ($events as $event)
        {
            $result = $this->whoWon($event);

            switch($result)
            {
                case static::EVENT_DRAW:
                    $status = static::EVENT_STATUS_COMPLETED;
                    break;

                case static::EVENT_HOME_WIN:
                    $status = static::EVENT_STATUS_COMPLETED;
                    break;

                case static::EVENT_AWAY_WIN:
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
    }
} 