<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
//use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuItemModel extends Node
{
    public $timestamps = false;

    protected $table = 'menu_items';

    protected $fillable = ['parent_id', 'lvl', 'lft', 'rgt', 'slug'];


    // 'depth' column name
    protected $depthColumn = 'lvl';

    public function entities()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

//    public function getCreatedAtAttribute($date)
//    {
//        return Carbon\Carbon::createFromTimestamp($date)->format('Y-m-d H:i:s');
//    }
//
//    public function getUpdatedAtAttribute($date)
//    {
//        return Carbon\Carbon::createFromTimestamp($date)->format('Y-m-d H:i:s');
//    }
//    protected $hidden = ['pivot'];

//    protected $guarded = ['id'];
}