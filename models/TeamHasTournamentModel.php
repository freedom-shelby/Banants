<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class TeamHasTournamentModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'teams_has_tournaments';

    protected $fillable = ['tournament_id', 'team_id', 'pos', 'played', 'points', 'win', 'draw', 'lose', 'goals_for', 'goals_against', 'difference'];


    public function team()
    {
        return $this->belongsTo('TeamModel', 'team_id')->first();
    }

    public function tournament()
    {
        return $this->belongsTo('TournamentModel', 'tournament_id')->first();
    }
}