<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\CheckInTimes;
use Illuminate\Http\Request;
use Session;

class CheckInTimesController extends Controller
{
    public function store(Request $request){
        $array = [];

        /*
         * Set all checked days with their times
         *TODO
         * [ ] Check if the admin is removing or changing any of the dates
         *      [ ] Need to alert the admin if there is any issues with the bookings if they choose
         *          remove any or change a date that already has a booking
         * */

        if($request->monday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'monday', $request->monday_time);
            array_push($array, $checkIn);
        }
        if($request->tuesday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'tuesday', $request->tuesday_time);
            array_push($array, $checkIn);
        }
        if($request->wednesday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'wednesday', $request->wednesday_time);
            array_push($array, $checkIn);
        }
        if($request->thursday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'thursday', $request->thursday_time);
            array_push($array, $checkIn);
        }
        if($request->friday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'friday', $request->friday_time);
            array_push($array, $checkIn);
        }
        if($request->saturday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'saturday', $request->saturday_time);
            array_push($array, $checkIn);
        }
        if($request->sunday){
            $checkIn = new CheckInTimes;
            $checkIn->setDay($request, 'sunday', $request->sunday_time);
            array_push($array, $checkIn);
        }

        //Delete the previous data in the table
        CheckInTimes::truncate();
        //insert all the days and times in the check in table
        $cal = new Calendar;
        foreach($array as $day){
            $day->save();
        }

        /*
         *TODO::
         * [ ] Allow admin to set a end date for the calendar.
         * [ ] Prevent the user to set a previous date
         * [ ] Don't allow the admin to set any date more than 5 months.
         * [ ] Allow the admin to change the date
         * [ ] Check for all the bookings that are
         * */
        $checkInDates = $cal->generateCalendar($array, date('2019-06-30'));
//        dd($checkInDates);
        //delete the previous data from the table
        Calendar::truncate();
        //Create and save each date in the calendar
        foreach($checkInDates as $checkInDate){
            $cal = new Calendar;
            $cal->date = $checkInDate;
            $cal->save();
        }

        Session::flash('success', 'Successfully changed the time of the ');
        return redirect()->route('bookingSettings.index');

    }

    /*
     *
     * */
    public function edit(){
        $checkInTime = CheckInTimes::all();
        return view('admin.settings.checkInTimes.edit')->with('checkInTime', $checkInTime);
    }

    public function update(Request $request){

    }
}
