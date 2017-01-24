<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 13.07.2015
 * Time: 22:42
 */

namespace Cache;
restrictAccess();

class LocalStorage {

    const STORAGE_DIR = 'localstorage/';

    protected $_timeLimit = 3600;

    protected $_path;

    protected $_data;

    protected $_encKey = 'banantssecretkey';

    public function save(){
        $crypt = \Crypt::Rijndahel();
        $crypt->setKey($this->_encKey);
        file_put_contents($this->_getFullPath(), $crypt->encrypt($this->_data));
    }

    public function setLocalPath($path){
        $this->_path = $path;
        return $this;
    }

    public function setTimeLimit($time){
        $this->_timeLimit = (int) $time;
        return $this;
    }

    public function setData($data){
        $this->_data = $data;
        return $this;
    }
    public function getData(){
        return $this->_data;
    }

    public function load(){
        if(file_exists($this->_getFullPath())){
            $crypt = \Crypt::Rijndahel();
            $crypt->setKey($this->_encKey);
            $this->_data = $crypt->decrypt(file_get_contents($this->_getFullPath()));
        }
        return $this;
    }

    public function createOrUpdate(){
        if(file_exists($this->_getFullPath())){
            if(time() - filemtime($this->_getFullPath())  > $this->_timeLimit){
                $this->save();
            }

        }else{
            $this->save();
        }
    }

    public function clear(){
        @unlink($this->_getFullPath());
    }

    public function isValid(){
        return (file_exists($this->_getFullPath()) AND (time() - filemtime($this->_getFullPath())  < $this->_timeLimit));
    }

    protected function _getFullPath(){
        return $this->_makePath();
    }

    protected function _makePath(){
        $path = explode('/',$this->_path);
        $fileName = $path[sizeof($path)-1];;
        unset($path[sizeof($path) - 1]);

        for($i = 0; $i < 3; $i++){
            $path[] = substr($fileName,$i*2,2);
        }

        $path = ROOT_PATH.static::STORAGE_DIR.'/'.implode('/',$path);
        if(!is_dir($path)){
            @mkdir($path,0755,true);
        }
        return $path.'/'.$fileName;

    }

    public function clearAll(){
        @unlink(ROOT_PATH.static::STORAGE_DIR);
    }
}