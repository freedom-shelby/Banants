<?php restrictAccess();
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 26.05.2015
 * Time: 11:31
 * Клас предназначен для шифровки и расшифровки данных
 * Использует Rijndael 256 шифрование, добавляет дополнительные символы к зашифрованным данным для большей надёжности
 */

class Crypt {

    private function __construct(){}

    /**
     * Возвращает Экземпляр класса шифрования алгоритмом Rijndael 256 CBC
     * @return \Crypt\Rijndael
     */
    public static function Rijndahel(){
        return new Crypt\Rijndael();
    }

    /**
     * Возвращает Экземпляр класса шифрования алгоритмом Caesar
     * @return \Crypt\Caesar
     */
    public static function Caesar(){
        return new Crypt\Caesar();
    }

    /**
     * Возвращает Экземпляр класса шифрования алгоритмом DoubleSqr
     * @return \Crypt\DoubleSqr
     */
    public static function DoubleSqr(){
        return new Crypt\DoubleSqr();
    }

    /**
     * Возвращает Экземпляр класса шифрования алгоритмом Sha256
     * @return \Crypt\Sha256
     */
    public static function Sha256(){
        return new Crypt\Sha256();
    }
}