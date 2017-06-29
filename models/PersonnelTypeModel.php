<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class PersonnelTypeModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'personnel_types';

    protected $fillable = ['template', 'type'];

    public function personnel()
    {
        return $this->hasMany('PersonnelModel', 'personnel_type_id');
    }
}