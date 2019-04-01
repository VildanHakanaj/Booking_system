<?php

namespace App\Http\Controllers;

use App\CheckInTimes;
use Illuminate\Http\Request;

class CheckInTimesController extends Controller
{
    public function create(){
        return view('admin.settings.checkInTimes.create');
    }

    public function store(Request $request){
        $array = [];
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

        CheckInTimes::truncate();
        foreach($array as $day){

            $day->save();
        }

    }

    /*
     *
     * */
    public function edit(){
        $checkInTime = CheckInTimes::all();
        return view('admin.settings.checkInTimes.edit')->with('days', $checkInTime);
    }

    public function update(Request $request){

    }
}
