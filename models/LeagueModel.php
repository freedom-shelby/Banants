<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class LeagueModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'team_leagues';

    protected $fillable = ['entity_id', 'country_id', 'photo_id', 'status', 'slug'];


    public function text()
    {
        return $this->belongsTo('EntityModel', 'entity_id')->first()->text;
    }

    public function entity()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

    public function country()
    {
        return $this->belongsTo('CountryModel', 'country_id')->first();
    }

    /**
     * Загрузка картинки по-умолчанию
     */
    public function defaultImage()
    {
        return $this->belongsTo('PhotoModel', 'photo_id')->first();
    }

}