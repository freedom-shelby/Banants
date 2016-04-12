<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
//use Illuminate\Database\Eloquent\Model as Eloquent;

class ArticleModel extends LangModel
{
    public $timestamps = true;

    protected $table = 'articles';

    protected $fillable = ['parent_id', 'lvl', 'lft', 'rgt', 'slug'];

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($ArticleModel) { // before delete() method call this

            $ArticleModel->contents()->detach($ArticleModel->id);
            // do the rest of the cleanup...
        });
    }

    // 'depth' column name
    protected $depthColumn = 'lvl';

    public function contents()
    {
        return $this->belongsToMany('ContentModel', 'articles_has_contents', 'article_id', 'content_id');
    }

    public function widgets()
    {
        return $this->belongsToMany('WidgetModel', 'articles_has_widgets', 'article_id', 'widget_id');
    }

    /**
     * Загрузка толкп тех виджетов которие принедлежат именно этому
     */
    public function onlySelfWidgets()
    {
        return $this->belongsToMany('WidgetModel', 'articles_has_only_self_widgets', 'article_id', 'widget_id');
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