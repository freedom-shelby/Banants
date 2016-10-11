<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class VideoModel extends Eloquent
{
    protected $table = 'videos';

    public $timestamps = true;

//    protected $hidden = ['pivot'];

//    protected $guarded = ['id'];

    protected $fillable = ['youtube_id', 'path'];

}