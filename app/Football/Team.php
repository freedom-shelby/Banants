<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 23.04.2016
 * Time: 8:38
 */

namespace Football;

use Football\Player;

class Team
{
    /**
     * Активние Игроки
     * @var array[Player]
     */
    protected $_items = [];

    public function __construct()
    {

    }

    public function init($model)
    {
//        $data = $model->players()->whereStatus(1)->orderBy('position_id')->get();
        $data = $model->players()->whereStatus(1)->get();

        foreach ($data as $item) {

            $tmp = new Player;
            $tmp->init($item);

            $this->_items[] = $tmp;
        }
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->_items;
    }


}