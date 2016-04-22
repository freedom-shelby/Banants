<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class CountryModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'countries';

    protected $fillable = ['title_id', 'background_flag', 'flag', 'iso'];


    public function title()
    {
        return $this->belongsTo('EntityModel', 'title_id')->first()->text;
    }
}