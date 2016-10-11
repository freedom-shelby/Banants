<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class TournamentTypeModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'tournament_types';

    protected $fillable = ['entity_id', 'type'];


    public function text()
    {
        return $this->entity()->first()->text;
    }

    public function entity()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }
}