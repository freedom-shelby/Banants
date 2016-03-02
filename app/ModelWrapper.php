<?php

/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 02.03.2016
 * Time: 4:24
 */
use \Lang\Lang;
restrictAccess();
class ModelWrapper
{
    private $_data;

    public function __construct($json)
    {
        $this->_data = json_decode($json,true);

        if(isset($this->_data['contents'])){
            $this->_data['content'] = null;
            foreach($this->_data['contents'] as $content){
                if($content['lang_id'] == Lang::instance()->getCurrentLang()['id']){
                    $this->_data['content'] = $content;
                }
            }

            unset($this->_data['contents']);

        }
    }

    public function __get($key)
    {
        if($key === 'content') return null;

        return  isset($this->_data[$key]) ? $this->_data[$key] : isset($this->_data['content'][$key]) ? $this->_data['content'][$key] : null;
    }

    public function __set($key, $value)
    {
        if($key !== 'content'){
            if(isset($this->_data[$key])){
                $this->_data[$key] = $value;
            }elseif(isset($this->_data['content'][$key])){
                $this->_data['content'][$key] = $value;
            }
        }
    }
}