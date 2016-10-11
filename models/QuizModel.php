<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.2014
 * Time: 14:42
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class QuizModel extends Eloquent {

    protected $table = 'quizs';

    public $timestamps = true;

    protected $guarded = ['id'];

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($model) { // before delete() method call this

            foreach ($model->answers()->get() as $item) {
                $item->entities()->delete();
            }

            $model->answers()->delete();
            $model->responses()->delete();
            $model->entities()->delete();
            // do the rest of the cleanup...
        });
    }

    public function answers()
    {
        return $this->hasMany('QuizAnswerModel', 'quiz_id');
    }

    public function responses()
    {
        return $this->hasMany('QuizResponsesModel', 'quiz_id');
    }

    public function entities()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

    public function question()
    {
        return $this->entities()->first()->text;
    }
} 