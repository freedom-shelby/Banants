<?php
/**
 * Created by SUR-SER.
 * User: SURO
 * Date: 23.06.2015
 * Time: 11:59
 */

namespace Helpers;


use DateTime;

class Date {

    public static function diff($from,$to){
        $start = new DateTime($from);
        $end  = new DateTime($to);
        $diff = $start->diff($end);
        return $diff->days;
    }

    public static function diffBetweenTimestamps($from,$to){
        $start = (new DateTime())->setTimestamp($from);
        $end = (new DateTime())->setTimestamp($to);
        $diff = $start->diff($end);
        return $diff->days;
    }
}