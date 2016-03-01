<?php
/**
 * Created by PhpStorm.
 * User: SUR0
 * Date: 01.03.2016
 * Time: 1:42
 * Интерфейс для обработчиков события
 */

namespace Event;


interface EventHandlerInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function handle($data);
}