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

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model as Eloquent;
use EventTeamStatisticModel;
use EventModel;
use Event;
use Setting;


abstract class AbstractType {

    // коэффициент забитих голов в гостях
    const GOAL_FACTOR = 0.0001;

    /**
     * winner [ 0 = pending, 1 = home, 2 = away, 3 = draw]
     * status [ 0 = pending, 1 = in progress, 2 = completed]
     */
    const EVENT_PENDING = 0;
    const EVENT_HOME_WIN = 1;
    const EVENT_AWAY_WIN = 2;
    const EVENT_DRAW = 3;
    const EVENT_STATUS_IN_PROGRESS = 1;
    const EVENT_STATUS_COMPLETED = 2;

    /**
     * Тип страницы
     */
    protected $_type;

    /**
     * Шаблон
     */
    protected $_template;

    protected $_model;
    protected $_id;
    protected $_name;
    protected $_fullName;
    protected $_teams;
    protected $_teamModels;
    protected $_events;
    protected $_defaultImage;
    protected $_current_round;
    protected $_max_rounds;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->_fullName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return mixed
     */
    public function getMaxRounds()
    {
        return $this->_max_rounds;
    }

    /**
     * @param $current_round
     * @return $this
     */
    public function setCurrentRound($current_round)
    {
        $this->_current_round = $current_round;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentRound()
    {
        return $this->_current_round;
    }

    /**
     * @return mixed
     */
    public function getDefaultImage()
    {
        return $this->_defaultImage;
    }

    /**
     * @param $model
     * @return AbstractType
     */
    public function init($model){

        $this->_model = $model;
        $this->_id = $model->id;
        $this->_name = $model->name();
        $this->_fullName = $model->fullName();
        $this->_type = $model->type();
        $this->_teams = $model->tableTeams();
        $this->_teamModels = $model->teams();
        $this->_events = $model->events();
        $this->_defaultImage = $model->defaultImage();
        $this->_current_round = $model->current_round;
        $this->_max_rounds = $model->max_rounds;

        return $this;
    }

    /**
     * Воврашает указаний тур
     * @param $round
     * @return mixed
     */
    public function getEventsByRound($round)
    {
        $events = $this->_model->events();
        return $events->whereRound($round)->get();
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->_events;
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->_teams;
    }

    /**
     * @return mixed
     */
    public function getLazyTeamModels()
    {
        return $this->_teamModels->with('entity');
    }

    /**
     * Максималное количество матчей за один тур
     * @return float|int
     */
    public function maxEventsPerRound()
    {
        return ($this->getTeams()->count() / 2);
    }

    /**
     * Рассчитывает предстоящий раунд
     * Изаписивает в базе
     * @return EventModel
     */
    public function generateCurrentEvent()
    {
        // Находит клуб Бананца который играет в текущем турнире
        $ownTeam = $this->getLazyTeamModels()
            ->where('is_own', '=', 1)
            ->first();

        $event = EventModel::where(['status' => static::EVENT_PENDING, 'home_team_id' => $ownTeam->id])
            ->orWhere(['status' => static::EVENT_PENDING, 'away_team_id' => $ownTeam->id])
            ->orderBy('played_at')
            ->first();

        $this->setCurrentRound($event->round)
            ->save();

        // Если это первая команда то сгенерировать Event для записи текущего собития в настройках
        if(Setting::instance()->getSettingVal('football.first_team') == $ownTeam->id)
        {
            Event::fire('Football.currentEventUpdate', $event);
        }
    }

    // todo: avelacnel API -ner@
    public function generateWith($driver)
    {
        if($driver instanceof Eloquent){
            return $this->init($driver);
        }elseif(is_array($driver)){
            return $this->loadFromArray($driver);
        }

        switch ($driver)
        {
            case 'Scorestime':
                return new Scorestime($this); // todo::
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }

    /**
     * Обновляет или создаёт собития
     *
     * @param $data['id'] ИД собития
     * @param $data['home']['team'] ИД домашней командий
     * @param $data['away']['team'] ИД гостевой командий
     * @param $data['home']['score'] Счёт домашней командий
     * @param $data['away']['score'] Счёт гостевой командий
     * @param $data['date'] Дата провидения матча
     * @param $data['home']['additional'] Счёт домашней командий в Дополнителное время
     * @param $data['away']['additional'] Счёт гостевой командий в Дополнителное время
     * @param $data['home']['pen'] Счёт домашней командий по Пеналти
     * @param $data['away']['pen'] Счёт гостевой командий по Пеналти
     * @param $round
     */
    public function updateOrCreateEvent($data, $round)
    {
        if (isset($data['id']) and ! is_null($model = EventModel::find($data['id'])))
        {
            $model->homeModel()->update([
                'team_id' => $data['home']['team'], 'team_formation_id' => 1, 'score' => ($data['home']['score'] !== '') ? $data['home']['score'] : null// todo:: team_formation_id -n statistikayic poxel
            ]);
//
            $model->awayModel()->update([
                'team_id' => $data['away']['team'], 'team_formation_id' => 1, 'score' => ($data['away']['score'] !== '') ? $data['away']['score'] : null// todo:: team_formation_id -n statistikayic poxel
            ]);

            $model->update([
                'home_team_id' => $data['home']['team'], 'away_team_id' => $data['away']['team'], 'played_at' => $data['date'], 'round' => $round,
            ]);
        }else{
            $home = EventTeamStatisticModel::create([
                'team_id' => $data['home']['team'],
                'team_formation_id' => 1,
                'score' => ($data['home']['score'] !== '') ? $data['home']['score'] : null// todo:: team_formation_id -n statistikayic poxel
            ]);

            $away = EventTeamStatisticModel::create([
                'team_id' => $data['away']['team'],
                'team_formation_id' => 1,
                'score' => ($data['away']['score'] !== '') ? $data['away']['score'] : null// todo:: team_formation_id -n statistikayic poxel
            ]);

            $model = EventModel::create([
                'tournament_id' => $this->getId(), 'played_at' => $data['date'], 'round' => $round, 'home_id' => $home->id, 'away_id' => $away->id
            ]);
        }
//        $this->getEvents()->home()->whereHome_id($data['home']['team']);
//        $this->getEvents()->away()->whereHome_id($data['away']['team']);
    }

    // todo: avelacnel API -ner@
    public function updateOrCreateEventWith($driver, $round)
    {
//        \TeamHasTournamentModel::updateOrCreate(
//            ['id' => $key],
//            ['pos' => $d['pos'], 'points' => $d['points'], 'win' => $d['win'], 'draw' => $d['draw'], 'lose' => $d['lose'], 'goals_for' => $d['goals_for'], 'goals_against' => $d['goals_against']]);

        if($driver instanceof Eloquent){
            return $this->init($driver);
        }elseif(is_array($driver)){
            return $this->loadFromArray($driver);
        }

        switch ($driver)
        {
            case 'Scorestime':
                return new Scorestime($this); // todo::
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }
    public static function firstOrNew(array $attributes)
    {
        if ( ! is_null($instance = static::where($attributes)->first()))
        {
            return $instance;
        }

        return new static($attributes);
    }
    public static function updateOrCreate(array $attributes, array $values = array())
    {
        $instance = static::firstOrNew($attributes);

        $instance->fill($values)->save();

        return $instance;
    }

    /**
     * Сортировка позиции таблицы
     */
    public function reSortingTable()
    {

    }

    /**
     * Запис в базу
     * @return $this
     */
    public function save()
    {
        $this->_model->update([
            'current_round' => $this->_current_round,
            'max_rounds' => $this->_max_rounds,
        ]);

        return $this;
    }

    public function __get($name)
    {
        return $this->_model->$name;
    }
} 