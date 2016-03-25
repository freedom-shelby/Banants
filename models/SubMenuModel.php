<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class SubMenuModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'sub_menus';

    protected $fillable = ['title'];


    public function items()
    {
        return $this->belongsTo('MenuModel', 'menu_id');
    }

//    protected $guarded = ['id'];
}