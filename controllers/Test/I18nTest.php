<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 26.01.2016
 * Time: 23:20
 */

/**
 * TEST TEST TEST
 */

namespace Test;

use Illuminate\Database\Eloquent\Model as Eloquent;


class I18nTest extends \Controller
{
    public function anyIndex(){

    }

    public function anyLang(){
        echo '<pre>';
        //$article = new ArticleModel();
        //$article->hasContent();
        \Langs::instance()->setCurrentLang('en');
        //print_r($article->title);
        //print_r(class_exists('LangsModel'));

        //$articles = (new ArticleModel())->find(2)->contents;
        ////print_r($articles);
        //foreach ($articles as $article) {
        //    print_r($article);
        //}

        //$article = (new ArticleModel())->contents();

        //$article = ArticleModel::find(1)->contents();
        //$article = (new ArticleModel());
        //print_r($article->find(1)->contents());

        //foreach (Article::all() as $item) {
        //    foreach ($item->contents()->get() as $article) {
        //        echo $article;
        //    }
        //}

        //foreach (Article::with('contents')->where('id', '=', 1) as $item) {
        //    print_r($item);
        ////    foreach ($item->contents() as $article) {
        ////        print_r($article);
        ////    }
        //}

        //$content = Article::find(1);
        //
        //foreach ($content->contents() as $article)
        //{
        //    print_r($article->pivot);
        //}

        //$contents = Article::all()->contents();
        //print_r($contents->getAttributes());
        //foreach ( Article::all() as $item) {
        //    foreach ($item->contents()->get() as $content)
        //    {
        //        print_r($content->getAttributes());
        //    }
        //}

        //foreach (Article::with('contents')->get() as $item) {
        //
        ////    $item->contents->each(function($item){
        ////        $item->addHidden(['id']);
        ////    });
        //
        //    foreach ($item->contents()->where('lang_id','=',1)->get() as $content)
        //    {
        //        echo $content->id;
        //        //  print_r($content->getAttributes());
        //    }
        //}

        //foreach (Content::with('articles')->where('lang_id', '=', '2')->get() as $item) {
        ////echo $item.'<br>';
        ////    $item->contents->each(function($item){
        ////        $item->addHidden(['id']);
        ////    });
        //    $a = $item;
        //    echo $a.'<br>';
        ////    foreach ($item->contents as $content)
        ////    {
        ////        echo $content;
        ////        //  print_r($content->getAttributes());
        ////    }
        //}

        //$cont = Article::find(1)->belongsToMany('Content', 'articles_has_contents', 'article_id', 'content_id')->where('lang_id', '=', '2')->first();
        //    echo $cont.'<br>';

        //foreach ($cont->get() as $item) {
        //echo $item.'<br>';
        //    $item->contents->each(function($item){
        //        $item->addHidden(['id']);
        //    });
        //    $a = $item;
        //    echo $a.'<br>';
        //    foreach ($item->contents as $content)
        //    {
        //        echo $content;
        //        //  print_r($content->getAttributes());
        //    }
        //}

//        $a = new \ArticleModel();
//        print_r(str_replace('_model', '', $a->getForeignKey()));die;

//        $article = (new \ArticleModel())->find(1);     //  ->where('article_id', '=', 3)  //  ->where('lang_id', '=', '2')
//
//        echo($article->title);
    }

    public function anyTestLangRoute()
    {
        var_dump( \Langs::instance()->getCurrentLang());
        $article = (new \ArticleModel())->find(1);
        echo($article->id);echo "<br>";
        echo($article->title);echo "<br>";
        echo($article->desc);echo "<br>";
        echo(\Helpers\Uri::makeUri('TestLangRoute.html'));echo "<br>";
    }
    
    public function anyWithLayout(){
        $view = \View::make('index');

        $view->withGlobal('test','test Global Var');
        $view->layout = \View::make('test/layout');
        $view->layout->a = 'local var A';
        $view->layout
            ->with('b','local var b')
            ->with('c','local var c')
            ->d = 'local var d';
        echo $view;
    }
}
//class LangModel extends Eloquent{
//
//    public $content;
//
////    public $title;
////    public $desc;
////    public $meta_title;
////    public $meta_desc;
////    public $meta_keys;
////    public $crumb;
//
////    public function __construct()
////    {
////        parent::__construct();
////
////        $this->content = ContentsModel::factory()->getContent($this, Langs::instance()->getCurrentLang()['iso']);
////
////        $this->title = $this->content['title'];
////        $this->desc = $this->content['desc'];
////        $this->meta_title = $this->content['meta_title'];
////        $this->meta_desc = $this->content['meta_desc'];
////        $this->meta_keys = $this->content['meta_keys'];
////        $this->crumb = $this->content['crumb'];
////    }
//
//    public function __get($name)
//    {
//
//        if(!is_null(parent::__get($name))) return parent::__get($name);
//
//        if($this->content == null){
//            $this->content = ContentsModel::factory()->getContent($this, Langs::instance()->getCurrentLang()['iso']);
//        }
//
//        return $this->content[$name];
////        return parent::__get($name);
////        return $this->content[$name];
//
////        var_dump($this->id);die;
////        return (new ContentsModel)->getContent($this, Langs::instance()->getCurrentLang()['iso']);
//    }
//
//}

//class ArticleModel extends LangModel{
////    public $id = 1;
//
////    public $throughTable = 'articles_has_contents';
////    public $foreignKey = 'article_id';
//
//    public $table = 'articles';
//
//    public function contents()
//    {
//        return $this->belongsToMany('ContentsModel', 'articles_has_contents', 'article_id', 'content_id');
//    }
////    public function hasContent( )
////    {
////        return new ContentsModel($this->throughTable, $this->foreignKey);
////    }
//}

//class GalleryModel extends LangModel{
//    public $id = 2;
//
//}

//class ContentsModel extends Eloquent{
//    public static $content;
//
////    public function __construct($throughTable, $foreignKey, $farKey = 'content_id')
////    {
////        parent::__construct();
////    }
//    public $table = 'contents';
//
//    public function articles()
//    {
//        return $this->belongsToMany('ArticleModel', 'articles_has_contents', 'content_id', 'article_id');
//    }
//
//    /**
//     * Фабричный метод для Модели
//     * экземпляр класса Модели
//     * @return $this
//     */
//    public static function factory()
//    {
//        return new self();
//    }
//
////    public function articles(){
////        return $this->hasMany('ArticleModel','article_id','content_id');
////    }
//
//
//    /**
//     * @param $parent
//     * @param $lang
//     * response (new ContentsModel)->getContent($this, Langs::instance()->getCurrentLang()['iso']);
//     */
//    public function getContent($parent, $lang)
//    {
//
////        self::$content = [
////            1 => [
////                'ru' => ['title' => 'Заголовок 1',],
////                'en' => ['title' => 'Header 1'],
////            ],
////            2 => [
////                'ru' => ['title' => 'Галерия 2'],
////                'en' => ['title' => 'Gallery 2'],
////            ]
////        ];
//
//
////        $a = $parent->find(2)->belongsToMany('ContentsModel', 'articles_has_contents', 'article_id', 'content_id');
//
////        $a = $parent->find(1)->contents();
////        print_r('<pre>');
////        print_r($a);die;
//
////        return $parent->belongsToMany('ContentsModel', 'articles_has_contents', 'article_id', 'content_id')->find($parent->id);
//
////        $a = $this->hasManyThrough('ContentsModel', 'ArticleModel')->first();
////        print_r('<pre>');
////        print_r($a);
//echo $parent->belongsToMany('Content', 'articles_has_contents', 'article_id', 'content_id')->where('lang_id', '=', '1')->first();die;
//print_r(get_class($parent));die;
//
////        if(array_key_exists($parent->id, self::$content)){
////            return array_key_exists($lang, self::$content[$parent->id]) ? self::$content[$parent->id][$lang] : null;
////        }
//
//    }
//}

//class Content extends Eloquent {
//
//    public $table = 'contents';
//
////    public function articles()
////    {
////        return $this->belongsToMany('Article', 'articles_has_contents', 'content_id', 'article_id');
////    }
//
//}
//
//class Article extends Eloquent {
//
//    public $table = 'articles';
//
////    public function contents()
////    {
////        return $this->belongsToMany('Content', 'articles_has_contents', 'article_id', 'content_id');
////    }
//
//}




/**
 * # TEST ES TES TES TEST
 */