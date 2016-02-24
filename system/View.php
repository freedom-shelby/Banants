<?php  if(!defined('ROOT_PATH')){header('HTTP/1.0 404 Not Found'); die("<h1>404 Not Found</h1>The page that you have requested could not be found.");}

/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 02.09.2015
 * Time: 15:16
 * Класс преднозначен для создания файлов видов
 */
class View
{
    private $_path;

    private $_data = [];

    private static $_globalData = [];

    private $_viewRoot = 'views';

    public function __construct($path,$data = [],$viewRoot = null){
        $this->_path = $path;
        $this->_data = $data;
        $this->_viewRoot = (!empty($viewRoot)) ? (ROOT_PATH.trim($viewRoot,'/').'/') : (ROOT_PATH.'views/');
    }

    public static function make($path, array $data = []){
        return new View($path,$data);
    }

    public function with($key,$val){
        $this->_data[$key] = $val;
        return $this;
    }

    public function withGlobal($key,$val){
        static::$_globalData[$key] = $val;
        return $this;
    }

    public function & __get($key)
    {
        if (array_key_exists($key, $this->_data))
        {
            return $this->_data[$key];
        }
        elseif (array_key_exists($key, static::$_globalData))
        {
            return static::$_globalData[$key];
        }
        else
        {
            throw new \Exception('Variable is not set for view: '.$key);
        }
    }

    public function __set($key, $val)
    {
        $this->_data[$key] = $val;
    }

    public function render(){
        extract($this->_data, EXTR_SKIP);

        if (static::$_globalData)
        {
            extract(static::$_globalData, EXTR_SKIP | EXTR_REFS);
        }

        ob_start();

        try
        {
            include $this->_viewRoot.$this->_path.EXT;
        }
        catch (Exception $e)
        {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }


    public function __isset($key)
    {
        return (isset($this->_data[$key]) OR isset(static::$_globalData[$key]));
    }

    public function __unset($key)
    {
        unset($this->_data[$key], static::$_globalData[$key]);
    }


    public function __toString()
    {
        try
        {
            return $this->render();
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }


}