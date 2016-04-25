<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.2014
 * Time: 14:42
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class UserModel extends Eloquent {

    protected $table = 'users';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function responses()
    {
        return $this->hasMany('QuizResponsesModel', 'user_id');
    }
} 