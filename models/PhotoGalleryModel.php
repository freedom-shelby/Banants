<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class PhotoGalleryModel extends Eloquent
{
    protected $table = 'photo_galleries';

    public $timestamps = true;

//    protected $hidden = ['pivot'];

//    protected $guarded = ['id'];

    protected $fillable = ['entity_id', 'slug'];

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($model) { // before delete() method call this

            $model->photos()->detach();
            // do the rest of the cleanup...
        });
    }

    public function photos()
    {
        return $this->belongsToMany('PhotoModel', 'photos_has_photo_galleries', 'photo_gallery_id', 'photo_id');
    }

    public function defaultImage()
    {
        return $this->photos()->first();
    }

    public function demoImages()
    {
        return $this->photos()->take(3)->get();
    }

    public function entities()
    {
        return $this->belongsTo('EntityModel', 'entity_id');
    }

    public function text()
    {
        return $this->entities()->first()->text;
    }
}