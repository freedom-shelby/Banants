<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class PositionModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'positions';

    protected $fillable = ['title_id', 'background'];


    public function title()
    {
        return $this->belongsTo('EntityModel', 'title_id')->first()->text;
    }
}