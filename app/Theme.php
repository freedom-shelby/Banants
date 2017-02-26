<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 25.02.2016
 * Time: 5:37
 * Класс-помошник для работы с  темой(со страницей)
 * некоторые вещи сделанны не верно (нет времени хернёй страдать)
 */
use Widgets\WidgetsContainer as WgtContainer;
use Menus\MenusContainer;

restrictAccess();
class Theme
{
    /**
     * Отрисовывыет виджеты для данной позиции
     * @param string $position позиция виджетов
     * @return mixed
     */
    public static function drawWidgets($position){
        echo WgtContainer::instance()->draw($position);
    }

    /**
     * Отрисовывыет виджет по типу
     * @param string $type позиция виджетов
     * @return mixed
     */
    public static function drawWidgetByType($type){
        echo WgtContainer::instance()->drawWidgetByType($type);
    }

    /**
     * Отрисовывыет меню для заданной позиции
     * @param string $position позиция виджетов
     * @return mixed
     */
    public static function drawMenu($position){
        echo MenusContainer::instance()->draw($position);
    }

    /**
     * Отрисовывыет суб-меню для заданной позиции
     * @param string $position позиция виджетов
     * @return mixed
     */
    public static function drawSubMenu($position){
        echo MenusContainer::instance()->drawSubMenu($position);
    }

    /**
     * Отрисовывает тэг Head с его стилями и скриптами
     * @return string
     */
    public static function drawHead(){
        echo static::$_page->getDoctype(),PHP_EOL,
            '<html '.static::$_page->getLang(),PHP_EOL.'>',
        static::$_page->getHead(true),PHP_EOL;
    }

    public static function drawContent(){

        echo static::$_page->getContent();

    }

    /**
     * Возвращает тег для скрипта
     * @param $file
     * @param null $attributes
     * @return string
     */
    public static function script($file,$attributes = null){
        if((strpos($file,'http://') !== false) or (strpos($file,'https://') !== false)){

            // Set the script link
            $attributes['src'] = $file;

            // Set the script type
            $attributes['type'] = 'text/javascript';

            return '<script'.HTML::attributes($attributes).'></script>';

        }else{
            return HTML::script('/media/assets/js/'.$file, $attributes);
        }
    }

    /**
     * Возврвщвет теги для файла стилей
     * @param $file
     * @param null $attributes
     * @return string
     */
    public static function style($file,$attributes = null){
        if((strpos($file,'http://') !== false) or (strpos($file,'https://') !== false)){

            // Set the stylesheet link
            $attributes['href'] = $file;

            // Set the stylesheet rel
            $attributes['rel'] = empty($attributes['rel']) ? 'stylesheet' : $attributes['rel'];

            // Set the stylesheet type
            $attributes['type'] = 'text/css';

            return '<link'.HTML::attributes($attributes).' />';

        }else{
            return HTML::style('/media/assets/css/'.$file, $attributes);
        }

    }

    /**
     * Возвращает скрипты для всего сайта
     * @return string
     */
    public static function defaultScripts(){
        $assets = static::_getThemeConfig('assets');
        $comments = $output = '';
        if($assets AND !empty($assets['js'])){
            foreach($assets['js'] as $js){
                if(isset($js['in-comment'])){
                    $comments .= static::commentedAssets(array(static::script($js['file'],isset($js['attributes']) ? $js['attributes'] : null).PHP_EOL),$js['in-comment']);
                }else{
                    $output .= static::script($js['file'],isset($js['attributes']) ? $js['attributes'] : null).PHP_EOL;
                }
            }
        }

        return $output.$comments;
    }

    /**
     * Возвращает скрипты для всего сайта
     * @return string
     */
    public static function bottomScripts(){
        $assets = static::_getThemeConfig('assets');
        $comments = $output = '';
        if($assets AND !empty($assets['bottomJS'])){
            foreach($assets['bottomJS'] as $js){
                if(isset($js['in-comment'])){
                    $comments .= static::commentedAssets(array(static::script($js['file'],isset($js['attributes']) ? $js['attributes'] : null).PHP_EOL),$js['in-comment']);
                }else{
                    $output .= static::script($js['file'],isset($js['attributes']) ? $js['attributes'] : null).PHP_EOL;
                }
            }
        }

        return $output.$comments;
    }


    /**
     * Возвращает стили для всего сайта
     * @return string
     */
    public static function defaultStyles(){
        $assets = static::_getThemeConfig('assets');
        $comments = $output = '';
        if($assets AND !empty($assets['css'])){
            foreach($assets['css'] as $css){
                if(isset($css['in-comment'])){
                    $comments .= static::commentedAssets(array(static::script($css['file'],isset($css['attributes']) ? $css['attributes'] : null).PHP_EOL),$css['in-comment']);
                }else{
                    $output .= static::style($css['file'],isset($css['attributes']) ? $css['attributes'] : null).PHP_EOL;
                }
            }
        }

        return $output.$comments;
    }

    /**
     * HTML комментарий
     * @param $text
     * @return string
     */
    public static function comment($text){
        return '<!-- '.$text.' -->';
    }

    /**
     * Комментирует тэги HTML ресурсов (для IE)
     * @param array $assets
     * @param string $condition
     * @return string
     */
    public static function commentedAssets(array $assets, $condition = 'lt IE 9'){
        $output = '';
        if(!empty($assets)){
            $output .= '<!--[if '.$condition.']>'.PHP_EOL;
            foreach($assets as $asset){
                $output .= $asset.PHP_EOL;
            }
            $output .= '<![endif]-->';
        }

        return $output;
    }

    private static function _getThemeConfig($key = null){
        static::_loadThemeConfig();
        return !$key ? static::$_themeConfig : isset(static::$_themeConfig[$key]) ? static::$_themeConfig[$key] : null;
    }

    private static $_themeConfig;
    private static $_configIsSearchedFlag = false;

    private static function _loadThemeConfig(){
        if(static::$_configIsSearchedFlag) return;
        static::$_themeConfig = (is_file('views/front/theme.config'.EXT)) ? require_once ('views/front/theme.config'.EXT) : null;
        static::$_configIsSearchedFlag = true;
    }

    private static $_page;

    public static function setPage($page){
        static::$_page = $page;
    }
}