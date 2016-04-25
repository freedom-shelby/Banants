<?php
/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 12/9/14
 * Time: 3:23 AM
 */
namespace Back;
restrictAccess();


use View;
use Setting;
use Helpers\Arr;
use Helpers\Uri;
use Message;
use Exception;
use Illuminate\Database\QueryException;
use Event;

class Quiz extends Back {

    public function anyIndex()
    {
        // todo: CORRECT
        $item = \QuizModel::find(1);
        $this->layout->content = View::make('back/quiz/list')
            ->with('item', $item);
    }
}