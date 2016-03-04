<?php
restrictAccess();

/**
 * Created by PhpStorm.
 * User: Suren
 * Date: 11/27/2015
 * Time: 12:06 PM
 */

//use Illuminate\Database\Eloquent\Model as Eloquent;
//use Baum\Node;
use Lang\Lang;

class LangModel extends Node
{
    protected $table = 'langs';

    public $content;

//    protected $hidden = ['pivot'];

//    protected $guarded = ['id'];

//    protected $fillable = ['name', 'iso_3', 'is_enabled'];


    public function __get($name)
    {

        if(!is_null(parent::__get($name))) return parent::__get($name);

        if($this->content == null){
            $this->content = (new \ContentModel())->getContent($this, Lang::instance()->getCurrentLang()['id']);
        }

        return $this->content[$name];
//        return parent::__get($name);
//        return $this->content[$name];

//        var_dump($this->id);die;
//        return (new ContentsModel)->getContent($this, Lang::instance()->getCurrentLang()['iso']);
    }
}