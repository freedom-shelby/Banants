<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 23.04.2016
 * Time: 8:38
 */

namespace Football;

use Carbon\Carbon;
use PlayerModel;


class Player
{
    protected $_defaultImage;
    protected $_firstName;
    protected $_lastName;
    protected $_fullName;
    protected $_age;
    protected $_number;
    protected $_country;
    protected $_position;
    protected $_slug;
    protected $_height;
    protected $_weight;
    protected $_wasBorn;
    protected $_article;


    public function __construct()
    {

    }

    /**
     * @param $model PlayerModel
     */
    public function init($model)
    {
        $this->_defaultImage = $model->defaultImage()->path;
        $this->_firstName = $model->firstName();
        $this->_lastName = $model->lastName();
        $this->_fullName = __($this->_firstName) . ' ' . __($this->_lastName);
        $this->_number = $model->number;
        $this->_country = $model->country();
        $this->_position = $model->position();
        $this->_slug = $model->slug();
        $this->_height = $model->height;
        $this->_weight = $model->weight;
        $this->_wasBorn = Carbon::parse($model->was_born)->format('d\\/m\\/Y');
        $this->_age = Carbon::parse($model->was_born)->age;
        $this->_article = $model->article();
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
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
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
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->_position;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->_slug;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /**
     * @return mixed
     */
    public function getWasBorn()
    {
        return $this->_wasBorn;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->_article;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->_age;
    }
}