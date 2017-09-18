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

    protected $_title = 'Team';
    protected $_banner;

    protected $_hasBanner = false;

    public function __construct()
    {

    }

    public function init($model)
    {
        $this->_title = $model->text();
        $this->_banner = $model->defaultBanner();
        $this->_hasBanner = $model->hasBanner();

//        $data = $model->players()->whereStatus(1)->orderBy('position_id')->get();
        $data = $model->players()->whereStatus(1)->orderBy('position_id')->orderBy('number')->get();

        foreach ($data as $item) {

            $tmp = new Player;
            $tmp->init($item);

            $this->_items[] = $tmp;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->_items;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {
        return $this->_banner;
    }

    /**
     * @return mixed
     */
    public function hasBanner()
    {
        return $this->_hasBanner;
    }
}