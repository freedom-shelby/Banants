<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 23.02.2017
 * Time: 14:32
 */

namespace Football\Events;

use Football\Tournaments\Types\AbstractType;
use InvalidArgumentException;
use Football\Events\Statistics\PDFToStatistic;
use Illuminate\Database\Eloquent\Model as Eloquent;
use EventModel;
use EventTeamStatisticModel;
use Football\Tournaments\Tournament;


class EventManager
{
    /**
     * @var EventModel
     */
    protected $_model;
    protected $_id;
    protected $_defaultImage;
    protected $_homeTeam;
    protected $_awayTeam;
    protected $_tournament;

    /**
     * Конструктор
     */
    public function __construct(){

    }

    static public function factory($data, $driver = null)
    {
        if(($data instanceof Eloquent) and $driver == null){
            return (new self())->init($data);
        }elseif(is_array($data) and $driver == null){
            return (new self())->loadFromArray($data);
        }

        switch ($driver)
        {
            case 'pdf':
                return (new self())->loadFromArray(PDFToStatistic::factory($data));

            case 'Scorestime':
                return (new self())->loadFromArray(ScorestimeToStatistic::factory($data)); // todo::
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }

    /**
     * @param $data array
     * @return $this
     */
    public function loadFromArray(array $data)
    {
        $this->_id = $data['event_id'];
        $this->_model = EventModel::find($data['event_id']);

        $this->updateOrCreateEventStats($data);

        return $this;
    }

    /**
     * @param $model EventModel
     * @return $this
     */
    public function init($model)
    {
        $this->_model = $model;
        $this->_id = $model->id;
        $this->_defaultImage = $model->defaultImage();
        $this->_homeTeam = $model->home();
        $this->_awayTeam = $model->away();
        $this->_tournament = Tournament::factory($model->tournament());

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultImage()
    {
        return $this->_defaultImage;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->_homeTeam;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->_awayTeam;
    }

    /**
     * @return AbstractType
     */
    public function getTournament()
    {
        return $this->_tournament;
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
     */
    public function updateOrCreateEventStats($data)
    {
//        $model = EventModel::find($data['event_id']);

        $homeModel = $this->_model->homeModel();
        $awayModel = $this->_model->awayModel();

        if ($homeModel->exists() and $awayModel->exists())
        {
            $homeModel->update($data['home']);
            $awayModel->update($data['away']);

            $this->_model->update([
                'photo_id' => $data['photo-id'],
            ]);
        }else{
            $home = EventTeamStatisticModel::create($data['home']);
            $away = EventTeamStatisticModel::create($data['home']);

            $this->_model->update([
                'home_id' => $home->id,
                'away_id' => $away->id,
                'home_team_id' => $data['home']['team_id'],
                'away_team_id' => $data['away']['team_id'],
                'photo_id' => $data['photo-id'],
            ]);
        }
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

    public function __get($name)
    {
        return $this->_model->{$name};
    }
}