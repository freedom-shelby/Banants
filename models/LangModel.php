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

//    public $title;
//    public $desc;
//    public $meta_title;
//    public $meta_desc;
//    public $meta_keys;
//    public $crumb;

//    public function __construct()
//    {
//        parent::__construct();
//
//        $this->content = ContentsModel::factory()->getContent($this, Lang::instance()->getCurrentLang()['iso']);
//
//        $this->title = $this->content['title'];
//        $this->desc = $this->content['desc'];
//        $this->meta_title = $this->content['meta_title'];
//        $this->meta_desc = $this->content['meta_desc'];
//        $this->meta_keys = $this->content['meta_keys'];
//        $this->crumb = $this->content['crumb'];
//    }

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