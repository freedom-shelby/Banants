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


abstract class AbstractType {

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
    protected $_current_round;
    protected $_max_rounds;

    public function getPosition(){}
    public function getSorting(){}
    public function render(){}

    /**
     * @var array $driver
     * @return AbstractType
     */
    public function loadFromForm($driver){
        return $this;
    }

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
        $this->_current_round = $model->current_round;
        $this->_max_rounds = $model->max_rounds;

        return $this;
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

    public function save()
    {
        $this->_model->update([
            'current_round' => $this->_current_round,
            'max_rounds' => $this->_max_rounds,
        ]);

        return $this;
    }
} 