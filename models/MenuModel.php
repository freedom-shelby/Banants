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


    public function items()
    {
        return $this->hasMany('MenuItemModel', 'menu_id');
//        return $this->belongsTo('EntityTranslationModel', 'entity_id');
    }

//    protected $guarded = ['id'];
}