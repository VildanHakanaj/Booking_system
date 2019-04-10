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
     * */
    public function calculateEndDate($start_date)
    {
        //get the calendar instance
        $cal = new Calendar;
        //start the end date where the start date is
        $end_date = new DateTime($start_date);
        //Add the first day
        $end_date->modify('+1 day');

        //Keep adding one day until the next check in date
        while($cal->where('date', $end_date->format('Y-m-d'))->count() == 0){
            $end_date->modify('+1 day');
        }

        return $end_date->format('Y-m-d')   ;
    }

    /*
     * Get all the upcoming bookings for all users
     *
     * */
    public function upComingBookings(){
        return $this->orderBy('start_date', 'ASC')->where('start_date', '>', date('Y-m-d'))->get();
    }

    /*
     * Get all the booking for today
     * */
    public function currentDayBookings(){

        return $this->where('start_date', date('Y-m-d'))->get();

    }
}
