<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 25.07.2015
 * Time: 1:24
 */
namespace Back;
restrictAccess();

use App;

class Back extends \Base{

    public function __construct(array $requestParams)
    {
        if( App::instance()->http()->getIpAddress() != '127.0.0.1' and
            App::instance()->http()->getIpAddress() != '109.75.47.150' and // Home
            App::instance()->http()->getIpAddress() != '81.16.8.9' and // Office
            App::instance()->http()->getIpAddress() != '93.109.241.42' and // Davit
            App::instance()->http()->getIpAddress() != '37.157.219.4' and // Davit
            App::instance()->http()->getIpAddress() != '87.241.188.58' and // Davit
            App::instance()->http()->getIpAddress() != '37.157.219.55' and // Davit
            App::instance()->http()->getIpAddress() != '37.157.219.63' and // Davit
            App::instance()->http()->getIpAddress() != '37.157.219.23' and // Davit
            App::instance()->http()->getIpAddress() != '87.241.188.112' and // Davit
            App::instance()->http()->getIpAddress() != '37.186.110.200' and // Davit
            App::instance()->http()->getIpAddress() != '37.157.219.22' and // Davit
            App::instance()->http()->getIpAddress() != '87.241.188.163' and // Banants
            App::instance()->http()->getIpAddress() != '87.241.184.177' and // Banants
            App::instance()->http()->getIpAddress() != '37.157.222.35' and
            App::instance()->http()->getIpAddress() != '109.75.44.36' and
            App::instance()->http()->getIpAddress() != '46.71.102.213' and
            App::instance()->http()->getIpAddress() != '37.157.219.54' and
            App::instance()->http()->getIpAddress() != '37.157.219.24') die('Error 404');

        parent::__construct($requestParams);
    }

    public function setLayout(){
        $this->layout = \View::make('back/index');
    }


//    public function anyIndex(){
//
//        $this->layout = \View::make('site/index');
////        $view->withGlobal('test','test Global Var');
//       // $charge = \Charge::instance();
//    }

//    public function getTest(){
//        $view = \View::make('index');
////        $view->withGlobal('test','test Global Var');
//        $view->layout = \View::make('test/layout');
//        $view->layout->a = 'local var A';
//        $view->layout
//            ->with('b','local var b')
//            ->with('c','local var c')
//            ->d = 'local var d';
//        echo $view;
//
////        echo "<form method='POST' action=''><input type='submit' value='Do POST'></form>";
//    }
}