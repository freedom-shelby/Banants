<?php
/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/19/2015
 * Time: 3:16 PM
 */

namespace Back;
restrictAccess();


use Event;
use Helpers\Uri;
use View;
use Message;
use Lang\Lang;
use Helpers\Arr;
use Illuminate\Contracts\Validation;
use ArticleModel;
use ContentModel;
use Illuminate\Database\Capsule\Manager as Capsule;
use Http\Exception as HttpException;
use Illuminate\Database\QueryException;
use TeamModel;
use PlayerModel;

class Teams extends Back
{
    public function getList(){

        $id = (int) $this->getRequestParam('id') ?: null;

        $items = PlayerModel::whereTeam_id($id)->get();

        $this->layout->content = View::make('back/team/list')
            ->with('id', $id)
            ->with('items', $items);
    }
}