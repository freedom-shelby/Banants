<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 02.09.2015
 * Time: 16:24
 */

namespace Test;


class ViewTests extends \Controller
{
    public function anyIndex(){
        $view = \View::make('index');
        echo $view;
    }

    public function anyWithLayout(){
        $view = \View::make('index');

        $view->withGlobal('test','test Global Var');
        $view->layout = \View::make('test/layout');
        $view->layout->a = 'local var A';
        $view->layout
            ->with('b','local var b')
            ->with('c','local var c')
            ->d = 'local var d';
        echo $view;
    }
}