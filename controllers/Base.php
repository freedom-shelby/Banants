<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:02 PM
 */
class Base extends Controller
{
    public $settings;
    public $langs;

    public function __construct(array $requestParams = [])
    {
//        error_reporting(E_ALL);
//        ini_set('display_errors', 'On');
//
//        if( App::instance()->http()->getIpAddress() != '91.204.190.4') throw new \Http\Exception(404);

        parent::__construct($requestParams);

//        $this->settings = \Setting::instance()->getAllGroups();
//        $this->langs = \Lang::instance();
    }
}