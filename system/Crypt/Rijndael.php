<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 27.05.2015
 * Time: 2:51
 * Клас предназначен для шифровки и расшифровки данных
 * Использует Rijndael 256 шифрование, добавляет дополнительные символы к зашифрованным данным для большей надёжности
 */

namespace Crypt;

restrictAccess();

class Rijndael {

    /**
     * @var string
     */
    private $key = '';
    private $cipher = MCRYPT_RIJNDAEL_256;
    private $cipher_mode = MCRYPT_MODE_CBC;

    public function __construct() {
        if(!function_exists('mcrypt_encrypt')) {
            throw new Exception('mcrypt library not installed.');
        }
    }

    /**
     * Задаёт ключ с помощю которого будет происходить шифрование
     *
     * @access public
     * @return void
     */
    public function setKey($key) {
        $this->key = hash('sha256', $key, TRUE);
    }

    /**
     * Шифрование данных
     *
     * @data данные которые нужно шифровать
     * @access public
     * @return string
     */
    public function encrypt($data) {
        $init_size = mcrypt_get_iv_size($this->cipher, $this->cipher_mode);
        $init_vect = mcrypt_create_iv($init_size, MCRYPT_RAND);
        return $this->randomString(strlen($this->key)).base64_encode($init_vect).base64_encode(mcrypt_encrypt($this->cipher, $this->key, $data, $this->cipher_mode, $init_vect));
    }

    /**
     * Расшифровка данных
     * base64( key+base64(IV) + base64(data) )
     * @data Data to decrypt
     * @access public
     * @return string
     */
    public function decrypt($data) {
        $data = substr($data, strlen($this->key));
        //$init_size = mcrypt_get_iv_size($this->cipher, $this->cipher_mode);
        //$init_vect = substr($data, 0, $init_size);
        $init_vect = substr($data, 0, 44);
        $data = substr($data, strlen($init_vect));
        return str_replace("\0","",mcrypt_decrypt($this->cipher, $this->key, base64_decode($data), $this->cipher_mode, base64_decode($init_vect)));
    }

    /**
     * Генерирует произвольную строку заданной длины
     *
     * @len Длина выходящей строки
     * @access private
     * @return string
     */
    private function randomString($len) {
        $str = '';
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pool_len = strlen($pool);
        for ($i = 0; $i < $len; $i++) {
            $str .= substr($pool, mt_rand(0, $pool_len - 1), 1);
        }
        return $str;
    }
}