<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class EntityTranslationModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'entities_translations';

    protected $fillable = ['text', 'lang_id', 'entity_id'];

    public function entity()
    {
//        return $this->hasMany('EntityTranslationModel', 'entity_id');
        return $this->belongsTo('EntityModel', 'entity_id');
    }

//    protected $guarded = ['id'];
}