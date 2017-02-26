<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 23.02.2017
 * Time: 14:40
 */

namespace Football\Events\Statistics;


class PDFToStatistic
{
    /**
     * Конструктор
     */
    public function __construct($data){
    }

    /**
     * Фабричный метод
     * @return array $item
     */
    public static function factory($data)
    {
        $item = (new self($data))->generate($data);

        return $item;
    }

    public function generate($data)
    {

    }
}