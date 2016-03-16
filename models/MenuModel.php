<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'menus';

    protected $fillable = ['title'];

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($entityModel) { // before delete() method call this

            $entityModel->translations()->delete();
            // do the rest of the cleanup...
        });
    }

    public function translations()
    {
        return $this->hasMany('EntityTranslationModel', 'entity_id');
//        return $this->belongsTo('EntityTranslationModel', 'entity_id');
    }

//    protected $guarded = ['id'];
}