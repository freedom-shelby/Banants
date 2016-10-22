<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.2014
 * Time: 14:42
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class QuizResponsesModel extends Eloquent {

    protected $table = 'quiz_responses';

    protected $guarded = ['id'];


    public function quiz()
    {
        return $this->belongsTo('QuizModel', 'quiz_id');
    }

    public function answer()
    {
        return $this->belongsTo('QuizAnswerModel', 'answer_id');
    }

    public function user()
    {
        return $this->belongsTo('QuizUserModel', 'user_id');
    }

} 