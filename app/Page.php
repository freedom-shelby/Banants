<?php
/**
 * Created by SUR-SER
 * User: SURO
 * Date: 03.10.14
 * Time: 0:52
 * Класс страницы
 * Употребляется в виде для отображения элементов страницы
 * по средствам его методов
 */

class Page {

    /**
     * Мета информация описания страницы
     * @var string
     */
    protected $_meta_title, $_meta_keys, $_meta_desc;

    /**
     * Скрипты и стили страницы
     * @var array()
     */
    protected $_styles = array(

    ),

        $_scripts = array(

    );

    /**
     * Информация страницы
     * @var string
     */
    protected $_title, $title_image_path, $_desc;

    /**
     * Баннер страницы
     */
    protected $_banner;

    /**
     * Слайдер страницы
     */
    protected $_slider;

    /**
     * Тип страницы
     */
    protected $_type;

    /**
     * Меню ресурса
     * @var array
     */
    protected $_menus = array();

    /**
     * Виды для элементов разметки
     * @var array
     */
    protected $_views = array(

    );

    protected $_custom_content;

    /**
     * Фабричный метод
     * Возвращает экземпляр класса Page
     * @return Page
     */
    public static function factory(){

        return new Page();
    }

    public function init(){


    }

    /**
     * Добавляет скрипты
     * @param $path mixed[string|array]
     * @return $this
     */
    public function set_scripts($path){

        if(is_array($path)){
            foreach($path as $p){
                $this->set_scripts($p);
            }
        }elseif(is_string($path)){
           $this->_scripts[] = $path;
        }

        return $this;
    }

    /**
     * Добавляет стили
     * @param $path mixed[string|array]
     * @return $this
     */
    public function set_styles($path){

        if(is_array($path)){
            foreach($path as $p){
                $this->set_styles($p);
            }
        }elseif(is_string($path)){
            $this->_styles[] = $path;
        }

        return $this;
    }

    /**
     * Возвращает разметку скриптов
     * @return string
     */
    public function get_scripts(){

        $output = '';

        foreach($this->_scripts as $s){

            $output .= '<script type=\'text/javascript\' src=' . $s . '></script>'.PHP_EOL;
        }

        return $output;
    }

    /**
     * Возвращает разметку стилей
     * @return string
     */
    public function get_styles(){

        $output = '';

        foreach($this->_styles as $s){

            $output .= '<link rel=\'stylesheet\' href=' . $s . ' type=\'text/css\'>'.PHP_EOL;
        }

        return $output;
    }

    /**
     * Возвращает разметку для заголовка страницы
     * @return View
     */
    public function get_title(){

    }

    public function get_content(){

    }

    /**
     * Возвращает разметку баннера
     * @return View
     */
    public function get_banner(){

        return $this->_banner;
    }

    /**
     * Устонавливает баннер для страницы
     * @param $banner
     * @return $this
     */
    public function set_banner($banner){
        $this->_banner = $banner;
        return $this;
    }

    /**
     * Возвращает разметку слайдера
     * @return View
     */
    public function get_slider(){
        return $this->_slider;
    }

    /**
     * Устонавливает слайдер для страницы
     * @param $slider
     * @return $this
     */
    public function set_slider($slider){
        $this->_slider = $slider;
        return $this;
    }

    /**
     * Возвращает текст мета тэга заголовка для страницы
     * @return string
     */
    public function get_meta_title(){

        return !empty($this->_meta_title) ? $this->_meta_title : $this->_title;
    }

    /**
     * Возвращает текст мета тэга ключевых слов для страницы
     * @return string
     */
    public function get_meta_keys(){

        return $this->_meta_keys;
    }

    /**
     * Возвращает текст мета тэга описания страницы
     * @return string
     */
    public function get_meta_desc(){

        return $this->_meta_desc;
    }

    public function set_custom_content($content){
        $this->_custom_content = $content;
    }

    public function set_title($title){
        $this->_title = $title;
    }

} 