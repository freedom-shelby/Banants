<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 27.05.2015
 * Time: 2:54
 */

namespace Crypt;


class Caesar {

    /**
     * Длина смещения шифрования
     * @var int
     */
    private $_shift;

    /**
     * Задаёт длину смещения шифрования
     *
     * @access public
     * @return void
     */
    public function setShift($length) {
        $this->_shift = $length;
    }

    /**
     * Шифрование данных
     *
     * @data данные которые нужно шифровать
     * @access public
     * @return string
     */
    public function encrypt($data) {
        $output = '';
        for ($x = 0; $x < strlen($data); $x++) {
            $y = ord(substr($data,$x,1)) + $this->_shift;
            /* Да, если величина более 255, надо вычесть
               поскольку отсчёт тогда начинается с начала алфавита */
            if ($y > 255) $y = $y - 255;
            $output = $output.chr($y);
        }
        return $output;
    }

    /**
     * Расшифровка данных
     *
     * @data Data to decrypt
     * @access public
     * @return string
     */
    public function decrypt($data) {
        $output = '';
        for ($x = 0; $x < strlen($data); $x++) {
            $y = ord(substr($data,$x,1)) - $this->_shift;
            if ($y < $this->_shift) $y = 255 - $this->_shift;
            $output = $output.chr($y);
        }
        return $output;
    }
}