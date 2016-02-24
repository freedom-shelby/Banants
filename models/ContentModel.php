<?php if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/27/2015
 * Time: 12:06 PM
 */
use Illuminate\Database\Eloquent\Model as Eloquent;

class ContentModel extends Eloquent
{
    public $timestamps = false;

    protected $table = 'contents';

    protected $fillable = ['title', 'crumb', 'desc', 'meta_title', 'meta_desc', 'meta_keys', 'lang_id'];

//    protected $guarded = ['id'];

    /**
     * @param $parent
     * @param $lang
     * response (new ContentsModel)->getContent($this, Langs::instance()->getCurrentLang()['iso']);
     */
    public function getContent($parent, $lang)
    {

        $throughTable = isset($parent->throughTable) ? $parent->throughTable : $parent->getTable() . '_has_contents';
        $foreignKey = isset($parent->foreignKey) ? $parent->foreignKey : str_replace('_model', '', $parent->getForeignKey());

        return $parent->belongsToMany('ContentModel', $throughTable, $foreignKey, 'content_id')->where('lang_id', '=', $lang)->first();

//        if(array_key_exists($parent->id, self::$content)){
//            return array_key_exists($lang, self::$content[$parent->id]) ? self::$content[$parent->id][$lang] : null;
//        }
    }
}