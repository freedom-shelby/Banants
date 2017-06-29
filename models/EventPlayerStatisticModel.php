<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class EventPlayerStatisticModel extends Eloquent
{
    protected $table = 'event_player_statistics';
    protected $guarded = [];
    public $timestamps = false;


    public function event()
    {
        return $this->belongsTo('EventModel', 'event_id')->first();
    }

    public function player()
    {
        return $this->belongsTo('PlayerModel', 'player_id')->first();
    }

    public function eventTeamStatistic()
    {
        return $this->belongsTo('EventTeamStatisticModel', 'player_id')->first();
    }
}