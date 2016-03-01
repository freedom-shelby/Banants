<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class WidgetModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'widgets';

    protected $fillable = ['template', 'sorting', 'position', 'status'];


    public function articles()
    {
        return $this->belongsToMany('ArticleModel', 'articles_has_widgets', 'widget_id', 'article_id');

//        return $this->hasMany('EntityTranslationModel', 'entity_id');
//        return $this->belongsTo('EntityTranslationModel', 'entity_id');
    }

//    protected $guarded = ['id'];
}