<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class CheckInTimes extends Model
{
    public function setDay(Request $request, $day, $time)
    {
        $request->validate(
            [
                $day . '_time' => 'required',
            ]
        );
        $this->day = $day;
        $this->hours = $time;
    }
}
