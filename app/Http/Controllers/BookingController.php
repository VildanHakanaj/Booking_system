<?php

namespace App\Http\Controllers;

use App\Booking;
use App\CheckInTimes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Response
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $booking = new Booking;
        $booking->start_date = $request->start_date;
        $booking->end_date = $booking->calculateEndDate($request->start_date);
        $booking->kit_id= $request->kit;
        $booking->user_id = auth()->user()->id;
        $booking->save();
        //Send user the verification email.
        auth()->user()->sendBookingVerification($booking);

        Session::flash('success', 'You have successfully booked a kit. Please check your email to verify');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Booking $booking
     * @return Response
     */
    public function show(Booking $booking)
    {

        return view('admin.bookings.show')->with('booking', $booking);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Booking $booking
     * @return void
     */
    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit')->with('booking', $booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Booking $booking
     * @return void
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate(
            [
                'start_date' => 'required|date',
                'end_date' => 'required|date'
            ]
        );
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->update();
        Session::flash('success', 'Booking was successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @return Response
     * @throws Exception
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        Session::flash('success', 'Your have successfully canceled your booking');
        return redirect()->back();
    }

    function search(Request $request)
    {
        dd("Searching");
//        if (empty($request->search)) {
//            return view('admin.bookings.index')->with('bookings', Booking::orderBy('created_at', 'desc')->paginate(10));
//        }

//        return view('admin.kits.index')->with('kits', $kits);
    }

}
