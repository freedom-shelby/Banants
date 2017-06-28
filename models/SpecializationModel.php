<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class SpecializationModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'specializations';

    protected $fillable = ['entity_id'];

    public function entities()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

    public function text()
    {
        return $this->entities()->first()->text;
    }
}