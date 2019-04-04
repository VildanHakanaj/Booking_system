<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Calendar;
use App\CheckInTimes;
use App\Kit;
use App\KitProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class KitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kits = Kit::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kits.index')->with('kits', $kits);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kits.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kit = new Kit();
        $request->validate(
            [
                'title' => 'required|min:2|max:255',
                'booking_window' => 'required|min:0|max:255',
            ]
        );

        $kit->createKit($request);
        $kit->save();

        Session::flash('success', 'Kit successfully created');
        return redirect()->route('kits.show', $kit->id)->with('kit', $kit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        $products = $kit->products();
        return view('admin.kits.show')->with('kit', $kit)->with('products', $products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        return view('admin.kits.edit')->with('kit', $kit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        $request->validate(
            [
                'title' => 'required|min:2|max:255',
                'booking_window' => 'required|min:0|max:255',
            ]
        );

        $kit->createKit($request);
        $kit->update();

        Session::flash('success', 'Kit successfully updated');
        return redirect()->route('kits.show', $kit->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        /*
         *TODO
         * [ ] Check if there is any items in the kit
         *      [ ] If yes notify the user if they want to continue
         *      [ ] If no just delete it.
         * [ ] In the future when the booking part comes in.
         *      [ ] Check if the kit is in any bookings
         *          [ ] if yes then don't allow the user to delete the kit
         *          [ ] If it it isn't then just do the above part.
         *
         * Right now this will delete it regardless of what the kit has.
         *
         * */
        //Delete the relation
        KitProduct::where('kit_id', $kit->id)->delete();

        //Delete the model
        Kit::where('id', $kit->id)->delete();
    }

    /*
     * Search for the item in the table
     *
     * @params $request
     * @return view of index bookings
     *
     * */
    public function search(Request $request)
    {
        if (empty($request->search)) {
            return view('admin.kits.index')->with('kits', Kit::orderBy('created_at', 'desc')->paginate(10));
        }
        $kits = Kit::orderBy('created_at', 'desc')->where('title', 'LIKE', '%' . $request->search . '%')->paginate(10);
        return view('admin.kits.index')->with('kits', $kits);
    }

    /*
     * Check if there there are items in the kit
     *
     * @return boolean
     * */
    public function checkProduct($id)
    {
        if (KitProduct::where('kit_id', $id)->count() > 0) {
            echo true;
        } else {
            echo false;
        }

    }

    /*
     *  Check if the kit is available on that date.
     *
     * @param Request
     * @return
     * */
    public function checkAvailability(Request $request)
    {
        $dates = new Calendar();
        $bookings = new Booking();
        $kit = new Kit();
        $request->validate([
            'kit' => 'required',
            'start_date' => 'required|date',
        ]);

        //Check if the date is a valid check in date
        if (!$dates->checkIfValid($request->start_date)) {
            Session::flash('error', 'Please make sure to pick a date that is a check in date');
            return redirect()->back();
        }

        //Check if the user wants to check all the available products for booking
        if ($request->kit === 'all') {
            return redirect()->back()->with(['kitsForBooking' => $kit->allAvailable($request->start_date)]);
        }

        //Get the kit by id
        $kit = Kit::find($request->kit);
        //Check if the kit is available for that date
        if ($kit->isAvailable($request->start_date)) {
            return redirect()->back()->with(['kitsForBooking' => Kit::where('id', $request->kit)->get(), 'bookable' => true]);
        }

        //Send an error to the user
        Session::flash('error', 'The item is already booked on ' . $request->start_date);
        return redirect()->back();
    }

    /*
     * Booking
     * */

    public function bookKit(){

    }
}
