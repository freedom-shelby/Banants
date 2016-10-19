<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class EventTeamStatisticModel extends Eloquent
{
    public $timestamps = true;

    protected $table = 'event_team_statistics';

    protected $fillable = ['team_id', 'team_formation_id', 'score', 'has_additional_time', 'created_at', 'updated_at'];


    public function team()
    {
        return $this->belongsTo('TeamModel', 'team_id')->first();
    }
}