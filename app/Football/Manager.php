<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 23.04.2016
 * Time: 8:38
 */

namespace Football;


class Manager
{
    protected $_defaultImage;
    protected $_firstName;
    protected $_lastName;
    protected $_fullName;
//    protected $_age;
    protected $_country;
    protected $_position;


    public function __construct()
    {

    }

    public function init($model)
    {
        $this->_defaultImage = $model->defaultImage()->path;
        $this->_firstName = $model->firstName();
        $this->_lastName = $model->lastName();
        $this->_fullName = __($this->_firstName) . ' ' . __($this->_lastName);
        $this->_country = $model->country();
        $this->_position = $model->position();
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


}