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

    protected $fillable = ['parent_id', 'entity_id', 'menu_id', 'icon', 'lvl', 'status', 'lft', 'rgt', 'slug'];


    // 'depth' column name
    protected $depthColumn = 'lvl';

    public function entities()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

    public function text()
    {
        return $this->entities()->first()->text;
    }

    public function menu()
    {
        return $this->belongsTo('MenuModel', 'menu_id')->first();
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($model) { // before delete() method call this

            $model->entities()->delete();
            // do the rest of the cleanup...
        });
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