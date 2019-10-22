<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Calendar;
use App\Kit;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class BookingController extends Controller
{
    /*
     *TODO::
     * [x] Show all the booking that exist in the booking page
     * [x] Allow the user to create the booking and store it
     * [x] Allow the booking to get canceled
     * [x] Have a booking settings pages to show
     * [x] Allow the admin to choose what the days the checkin and out are.
     *      [ ] Show the calendar of the dates and allow the admin to check the dates they don't want
     *      [ ] After the admin has selected the dates that they don't want then show the actual calendar that the user
     *          be able to see.
     * CALENDAR
     * [ ] The calendar will be able to be clicked on and place event listeners on what to do on those dates
     * SEARCH
     * [ ] Finish the searching functionality
     *
     *FIXME::
     * [ ] Fix the Search functionality
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
        $users = User::orderBy('name', 'ASC')->get();
        $kits = Kit::orderBy('title')
            ->where('status', '=', 1)
            ->get();
        return view('admin.bookings.create')->with('users', $users)->with('kits', $kits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

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
        Session::flash('success', 'You have successfully canceled the booking');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = new Booking();
        /*
         *TODO
         * [ ] Validate reques
         * [ ] Check if the booking exist
         * [ ] Check the date if it's within range
         * [ ] Check if the end date is a valid date
         * [ ] Save the user
         * */


        $request->validate(
            [
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'user_id' => 'required',
                'kit_id' => 'required'
            ]
        );

        //Make sure the user exist
        if(!User::find($request->user_id)){
            Session::flash('error', 'User selected doesn\'t exist');
            return redirect()->back();
        }

        //Check if the kit exists
        if(!Kit::find($request->kit_id)){
            Session::flash('error', 'Kit selected doesn\'t exist');
            return redirect()->back();
        }

        //Check if the user already has the same booking
//        dd(Booking::where('user_id', '=', $request->user_id)->where('kit_id', '=', $request->kit_id)->where('start_date', '=', $request->start_date)->get());
        if(Booking::where('user_id', '=', $request->user_id)->where('kit_id', '=', $request->kit_id)->where('start_date', '=', $request->start_date)->count() > 0){
            Session::flash('error', 'This user already has booked this item');
            return redirect()->back();
        }

        //Validate the dates
        $dates = new Calendar();
        if(!$dates->where('date', $request->start_date)){
            Session::flash('error', 'Pick a start date that\'s in the range');
            return redirect()->back();
        }
        if(!$dates->where('date', $request->end_date)){
            Session::flash('error', 'Pick an end date that\'s in the range');
            return redirect()->back();
        }



        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->kit_id = $request->kit_id;
        $booking->user_id = $request->user_id;
        $booking->save();
        //Send user the verification email.
        User::find($request->user_id)->sendBookingVerification($booking);
        Session::flash('success', 'You have successfully booked a kit for user: ' . User::find($request->user_id)->name);
        return redirect()->route('bookings.index');
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
