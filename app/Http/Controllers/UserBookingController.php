<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Kit;
use Session;
use Illuminate\Http\Request;

class UserBookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = new Booking;
        if(!Kit::find($request->kit)){
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }
        $booking->start_date = $request->start_date;
        $booking->end_date = $booking->calculateEndDate($request->start_date);
        $booking->kit_id = $request->kit;
        $booking->user_id = auth()->user()->id;
        $booking->save();
        //Send user the verification email.
        auth()->user()->sendBookingVerification($booking);

        Session::flash('success', 'You have successfully booked a kit. Please check your email to verify');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Booking::find($id);
        Booking::find($id)->delete();
        Session::flash('success', 'Booking was successfully canceled');
        return redirect()->back();
    }
}
