<?php
restrictAccess();

use Cache\LocalStorage as Cache;
use Http\Exception as HttpException;


/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 01.03.2016
 * Time: 3:19
 * Класс для генерации HTML контента
 */
class Page
{
    private $_metaTags;
    private $_charset = "<meta charset='utf-8'>\r\n";
    private $_title;
    private $_links;
    private $_lang = 'en';
    private $_doctype = "<!DOCTYPE html>\r\n";
    private $_plainHeader;
    private $_content;
    private $_breadcrumbs = [];

    /**
     * Добавление мета тега с атрибутом content
     * @param $name
     * @param $content
     */
    public function setMetaContent($name,$content){
        $this->_metaTags['c-'.$name] = '<meta name="'.$name.'" content="'.$content.'">'.PHP_EOL;
    }

    /**
     * Установка кодировки документа
     * @param $charset
     */
    public function setMetaCharset($charset){
        $this->_charset = '<meta charset="'.$charset.'">'.PHP_EOL;
    }

    /**
     * Установка тега http-equiv
     * @param $name
     * @param $content
     */
    public function setMetaEquiv($name,$content){
        $this->_metaTags['eq-'.$name] = '<meta http-equiv="'.$name.'" content="'.$content.'">'.PHP_EOL;
    }

    /**
     * Установка мета тега
     * @param $name
     * @param $content
     */
    public function setMetaName($name,$content){
        $this->_metaTags['n-'.$name] = '<meta name="'.$name.'" content="'.$content.'">'.PHP_EOL;
    }

    /**
     * Возвращает мета тегив HTML формате
     * @return string
     */
    public function getMetaTags(){
        $output = '';
        if(!empty($this->_metaTags)){
            foreach($this->_metaTags as $tag){
                $output .= $tag;
            }
        }
        return $output;
    }

    /**
     * Устанавливает заголовок документа
     * @param $title
     */
    public function setTitle($title){
        $this->_title = $title;
    }

    /**
     * Возвращает заголовок документа в HTML формате
     * @return string
     */
    public function getTitle(){
        return '<title>'.$this->_title.'</title>'.PHP_EOL;
    }

    /**
     * Установка тега link
     * @param null $rel
     * @param null $href
     * @param null $type
     * @param null $media
     */
    public function setLink($rel = null,$href = null,$type = null,$media = null){
        $output = '<link';
        $output .= $rel ? (' rel="'.$rel.'"') : '';
        $output .= $href ? (' href="'.$href.'"') : '';
        $output .= $type ? (' href="'.$type.'"') : '';
        $output .= $media ? (' href="'.$media.'"') : '';

        $this->_links[] = $output.'>'.PHP_EOL;
    }

    /**
     * Возвращает тэги link в HTML формате
     * @return string
     */
    public function getLinks(){
        $output = '';
        if(!empty($this->_links)){
            foreach($this->_links as $link){
                $output .= $link;
            }
        }
        return $output;
    }

    /**
     * Устанавливает путь к иконке документа
     * @param $path
     */
    public function setIcon($path){
        $this->setLink('shortcut icon',$path);
    }

    /**
     * Установка языка страницы
     * @param $lang
     */
    public function setLang($lang){
        $this->_lang = $lang;
    }

    /**
     * Возвращяет язык страницы в HTML формате
     * @return string
     */
    public function getLang(){
        return 'lang="'.$this->_lang.'"';
    }

    /**
     * Установка doctype
     * @param $content
     */
    public function setDoctype($content){
        $this->_doctype = '<!DOCTYPE '.$content.'>'.PHP_EOL;
    }

    /**
     * Возвращает doctype в HTML формате
     * @return string
     */
    public function getDoctype(){
        return $this->_doctype;
    }

    /**
     * Возвращает шапку документа в HTML формате
     * @param bool $withThemeSettings
     * @return string
     */
    public function getHead($withThemeSettings = false){
        $output = '<head>'.PHP_EOL;
        $output .= $this->getTitle();
        $output .= $this->getMetaTags();
        if($withThemeSettings){
            $output .= Theme::defaultStyles();
            $output .= Theme::defaultScripts();
            $output .= $this->_plainHeader;

        }
        $output .= $this->getLinks();
        return $output .'</head>'.PHP_EOL;
    }

    /**
     * Установка параметров для шляпы в текстовом(чистом) формате
     * @param $text
     */
    public function setHeaderPlain($text){
        $this->_plainHeader = $text.PHP_EOL;
    }

    /**
     * Возвращает контент страницы
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Устанавливает контент для страницы
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * Добавляет хлебные крошки
     * @param $crumb
     */
    public function appendCrumb($crumb){
        if(is_array($crumb)){
            $this->_breadcrumbs += $crumb;
        }else{
            $this->_breadcrumbs[] = $crumb;
        }
    }

    /**
     * Возвращает хлебные крошки в HTML формате
     * @return mixed
     */
    public function getBreadcrumbs(){
        return Breadcrumb::withLinks($this->_breadcrumbs);
    }

    public function initFromSlug($slug)
    {
        $model = $this->getModelFromSlug($slug);

        $this->setMetaContent('description', $model->meta_desc ? htmlspecialchars($model->meta_desc) : htmlspecialchars($model->title));
        $this->setMetaContent('keywords', $model->meta_keys ? htmlspecialchars($model->meta_keys):  htmlspecialchars($model->title));
        $this->setTitle($model->meta_title ? htmlspecialchars($model->meta_title) : htmlspecialchars($model->title));
        $this->setContent($model->desc);
    }

    /**
     * @param $slug
     * @return ArticleModel
     * @throws HttpException
     */
    public function getModelFromSlug($slug)
    {
        $cache = new Cache();
        $cache->setLocalPath($slug.'_article');
        $cache->load();
        if($cache->isValid()){
            $model = new ModelWrapper($cache->getData());
        }else{
            $model = ArticleModel::where('slug','=',$slug)->with('contents')->first();
            if(empty($model)){
                throw new HttpException(404);
            }
            $cache->setData($model);
            $cache->save();
        }

        return $model;
    }
}