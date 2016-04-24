<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class TeamModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'teams';

    protected $fillable = ['article_id'];


    public function article()
    {
        return $this->belongsTo('EntityModel', 'article_id')->first();
    }

    public function players()
    {
        return $this->hasMany('PlayerModel', 'team_id');
    }
}