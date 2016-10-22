<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.2014
 * Time: 14:42
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class QuizUserModel extends Eloquent {

    protected $table = 'quiz_users';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function responses()
    {
        return $this->hasMany('QuizResponsesModel', 'user_id');
    }
}