<?php

namespace App\Libs;

use Carbon\Carbon;

class SystemUtil
{
    public static function convertHHIISSToSecond($pTimeHHIISS)
    {
        $seconds = null;
        if (!empty($pTime)) {
            $timeHHIISSArr = str_split(trim($pTimeHHIISS), 2);
            $seconds = array_reduce($timeHHIISSArr, function ($acc, $curr) {
                return $acc * 60 + $curr;
            }, 0);
        }
        return $seconds;
    }

    public static function getWorkTime($workTime)
    {
        if (!empty($workTime)) {
            $workTime = substr_replace($workTime, ':', 2, 0);
        }
        return $workTime;
    }
}
