<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingSettings extends Model
{
    function generateCalendar($end, $day){
        $dates = [];
        $from = new DateTime(date('Y-m-d'));
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($from, $interval, $end);
        foreach($period as $dt){
            if($dt->fromat('D') === $day){
                array_push($dt->format('Y-m-d'));
            }
        }

        dd($dates);

    }
}
