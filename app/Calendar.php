<?php

namespace App;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public function generateCalendar($array, $endDate)
    {
        $checkInDate = [];
        $period = new DatePeriod(
            new DateTime(date('Y-m-d')),
            new DateInterval('P1D'),
            new DateTime($endDate)
        );

        foreach ($period as $dt) {
            foreach ($array as $date) {
                if ($dt->format('D') === date('D', strtotime($date->day))) {
                    $this->date = $dt->format('Y-m-d');
                    array_push($checkInDate, $this->date);
                }
            }
        }

        return $checkInDate;
    }
}
