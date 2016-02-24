<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 26.01.2016
 * Time: 23:20
 */

/**
 * TEST TEST TEST
 */

namespace Test;

use Baum\Node;
use Helpers\Uri;
use Illuminate\Database\Eloquent\Model as Eloquent;


class FakerTest extends \Controller
{
    public function anyIndex()
    {
        echo \View::make('test/faker');


    }

    public function anyIndex2()
    {
//        var_dump(is_dir('tmp'));die;
        echo \View::make('test/faker2');


    }
}