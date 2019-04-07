<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function kit()
    {
        return $this->belongsTo(Kit::class);
    }

    /*
     * Calculate from the start date to the end date
     *TODO
     * [ ] Just jump to the next day of checkin
     * [ ] Just jump to the next ( Monday ) if the check in is a Monday
     * [ ]
     * */
    public function calculateEndDate($start_date)
    {

        $cal = new Calendar;
        $end_date = new DateTime($start_date);
        $end_date->modify('+1 day');

        while($cal->where('date', $end_date->format('Y-m-d'))->count() == 0){
            $end_date->modify('+1 day');
        }

        return $end_date;

    }
}
