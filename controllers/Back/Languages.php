<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 03/03/16
 * Time: 3:23 AM
 */

namespace Back;
restrictAccess();


use Helpers\Uri;
use Http\Exception;
use View;
use Message;
use Lang\Lang;
use LangModel;
use Helpers\Arr;

class Languages extends Back {

    protected $_flag;

    /**
     * Список всех элементов
     */
    public function getList(){

        $items = LangModel::get()->toArray();
        $this->layout->content = View::make('back/language/list')
            ->with('items', $items);
    }
}