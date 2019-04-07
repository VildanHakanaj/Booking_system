<?php

namespace App\Http\Controllers;

use App\Booking;
use App\CheckInTimes;
use Illuminate\Http\Request;
use Session;

class BookingController extends Controller
{
    /*
     *TODO::
     * [ ] Show all the booking that exist in the booking page
     * [ ] Allow the user to create the booking and store it
     * [ ] Allow the booking to get canceled
     * [ ] Have a booking settings pages to show
     * [ ] Allow the admin to choose what the days the checkin and out are.
     *      [ ] Show the calendar of the dates and allow the admin to check the dates they don't want
     *      [ ] After the admin has selected the dates that they don't want then show the actual calendar that the user
     *          be able to see.
     * CALENDAR
     * [ ] The calendar will be able to be clicked on and place event listeners on what to do on those dates
     * SEARCH
     * [ ] Finish the searching functionality
     * */
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.bookings.index')->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = new Booking;
        $booking->start_date = $request->start_date;
        $booking->end_date = $booking->calculateEndDate($request->start_date);
        $booking->kit_id= $request->kit;
        $booking->user_id = auth()->user()->id;
        $booking->save();

        Session::flash('success', 'You have successfully booked a kit. Please check your email to verify');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {

        return view('admin.bookings.show')->with('booking', $booking);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    function search(Request $request)
    {
        dd("Searching");
//        if (empty($request->search)) {
//            return view('admin.bookings.index')->with('bookings', Booking::orderBy('created_at', 'desc')->paginate(10));
//        }
//        $kits = Kit::orderBy('created_at', 'desc')->where('user_id', 'LIKE', '%' . $request->search . '%')->paginate(10);
//        return view('admin.kits.index')->with('kits', $kits);
    }

}
