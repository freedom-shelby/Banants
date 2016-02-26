<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 25.07.2015
 * Time: 1:24
 */
namespace Front;


use View;

class Front extends \Base{


    public function setLayout(){
        $this->layout = View::make('front/index');
    }

//    public function anyIndex(){
//
//        $this->layout = \View::make('site/index');
////        $view->withGlobal('test','test Global Var');
//
//
//       // $charge = \Charge::instance();
//
//
//
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
//
//
//    public function postTest(){
//        echo "postTest";
//    }
}