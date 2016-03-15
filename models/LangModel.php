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

    public $timestamps = false;

    public $content;

//    protected $hidden = ['pivot'];

//    protected $guarded = ['id'];

    protected $fillable = ['name', 'iso', 'status'];


    public function __get($name)
    {

        if((parent::__get($name)) !== null) return parent::__get($name);

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