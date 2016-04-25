<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.2014
 * Time: 14:42
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class QuizAnswerModel extends Eloquent {

    protected $table = 'quiz_answers';

    public $timestamps = false;

    protected $guarded = ['id'];


    public function quiz()
    {
        return $this->belongsTo('QuizModel', 'quiz_id');
    }

    public function responses()
    {
        return $this->hasMany('QuizResponsesModel', 'quiz_answer_id');
    }


    public function entities()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

    public function title()
    {
        return $this->entities()->first()->text;
    }
} 