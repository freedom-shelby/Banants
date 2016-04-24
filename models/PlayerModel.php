<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class PlayerModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'players';

    protected $fillable = ['first_name_id', 'last_name_id', 'full_name_id', 'country_id', 'position_id'];


    public function firstName()
    {
        return $this->belongsTo('EntityModel', 'first_name_id')->first()->text;
    }

    public function lastName()
    {
        return $this->belongsTo('EntityModel', 'last_name_id')->first()->text;
    }

    public function fullName()
    {
        return $this->belongsTo('EntityModel', 'full_name_id')->first()->text;
    }

    public function country()
    {
        return $this->belongsTo('CountryModel', 'country_id')->first();
    }

    public function position()
    {
        return $this->belongsTo('PositionModel', 'position_id')->first();
    }

    /**
     * Загрузка картинки по-умолчанию
     */
    public function defaultImage()
    {
        return $this->belongsTo('PhotoModel', 'photo_id')->first();
    }

}