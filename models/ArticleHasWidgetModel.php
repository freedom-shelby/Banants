<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class ArticleHasWidgetModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'articles_has_widgets';

    protected $fillable = ['article_id', 'widget_id'];

//    protected $guarded = ['id'];
}