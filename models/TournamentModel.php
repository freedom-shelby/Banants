<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class TournamentModel extends Eloquent
{
    const TOURNAMENT_ARTICLE = 'tournaments';

    public $timestamps = true;

    protected $table = 'tournaments';

    protected $fillable = ['name_id', 'full_name_id', 'type_id', 'photo_id', 'status', 'max_rounds', 'current_round', 'slug', 'started_at', 'ended_at'];


    public function name()
    {
        return $this->nameModel()->first()->text;
    }

    public function fullName()
    {
        return $this->fullNameModel()->first()->text;
    }

    public function nameModel()
    {
        return $this->belongsTo('EntityModel', 'name_id');
    }

    public function fullNameModel()
    {
        return $this->belongsTo('EntityModel', 'full_name_id');
    }

    public function country()
    {
        return $this->belongsTo('CountryModel', 'country_id')->first();
    }

    public function type()
    {
        return $this->belongsTo('TournamentTypeModel', 'type_id')->first();
    }

    public function teams()
    {
        return $this->belongsToMany('TeamModel', 'teams_has_tournaments', 'tournament_id', 'team_id')->withPivot('pos', 'points', 'win', 'draw', 'lose', 'goals_for', 'goals_against', 'difference');
    }

    public function tableTeams()
    {
        return $this->hasMany('TeamHasTournamentModel', 'tournament_id');
    }

    /**
     * Загрузка картинки по-умолчанию
     */
    public function defaultImage()
    {
        return $this->belongsTo('PhotoModel', 'photo_id')->first();
    }

    /**
     * Туры
     */
    public function events()
    {
        return $this->hasMany('EventModel', 'tournament_id');
    }

}