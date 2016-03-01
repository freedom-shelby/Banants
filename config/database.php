<?php
restrictAccess();

/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 9:01
 * Настройка и подключение к бд через ORM Eloquent
 */
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

//$capsule->addConnection([
//    'driver' => 'sqlite',
//    'database' => ROOT_PATH.'database.sqlite'
//
//]);
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'banants',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => '',
],'default');

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();
$capsule->bootEloquent();