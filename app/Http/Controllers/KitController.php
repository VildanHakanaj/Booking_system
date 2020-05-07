<?php

namespace App\Http\Controllers;

use App\Kit;
use Session;
use App\Booking;
use App\Calendar;
use App\KitProduct;
use Illuminate\Http\Request;
use App\Http\Requests\KitRequest;

class KitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view(
            'admin.kits.index',
            [
                'kits' => Kit::orderBy('created_at', 'desc')->paginate(10)
            ]
        );
    }

    public function create()
    {
        return view('admin.kits.create');
    }

    public function store(KitRequest $request)
    {
        $kit = Kit::create($request->validated());
        return redirect(route('kits.show', $kit))->with('kit', $kit)->with('success', 'Kit successfully created');
    }

    public function show(Kit $kit)
    {
        return view(
            'admin.kits.show',
            [
                'kit' => $kit,
                'products' => $kit->products()->get()
            ]
        );
    }

    public function edit(Kit $kit)
    {
        return view(
            'admin.kits.edit',
            [
                'kit' => $kit
            ]
        );
    }

    public function update(KitRequest $request, Kit $kit)
    {
        $kit->update($request->validated());
        return redirect(route('kits.show', $kit))->with('success', 'Kit successfully updated');
    }

    public function destroy(Kit $kit)
    {
        $kit->delete();
    }

    
    public function search(Request $request)
    {
        if (empty($request->search)) {
            return view('admin.kits.index')->with('kits', Kit::latest()->paginate(10));
        }
        
        return view(
            'admin.kits.index',
            [
                'kits' => Kit::search($request->search)
            ]
        );
    }

    /*
     * Check if there there are items in the kit
     *
     * @return boolean
     * */
    public function checkProduct($id)
    {
        echo KitProduct::where('kit_id', $id)->count() > 0 ? true : false;
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

        $rules = [
            'kit' => 'required',
        ];

        if (isset($request->start_date)) {
            $rules['start_date'] = 'date';
        }

        $request->validate($rules);

        /*
         * Check when a kit is available
         * kits [X]
         * date [ ]
         * */
        if (!isset($request->start_date) && $request->kit != 'all') {
            $kit = Kit::find($request->kit);
            $dates = $kit->getAvailableDates();
            return redirect()->back()->with(['kitsForBooking' => Kit::where('id', $request->kit)->get(), 'availableDates' => $dates]);
        }

        /*
         * Validate if the date is correct.
         *
         * */
        if (!$dates->checkIfValid($request->start_date)) {
            Session::flash('error', 'Please make sure to pick a date that is a check in date');
            return redirect()->back();
        }

        /*
         * Get all the kits that are available for a chosen date
         * Kit  [ ]
         * Date [X]
      * */
        if ($request->kit === 'all') {
            return redirect()->back()->with(['kitsForBooking' => $kit->allAvailable($request->start_date), 'availableDate' => $request->start_date]);
        }

        /*
         * Check if a kit is available on a date
         * Kit  [x]
         * Date [x]
         * */
        $kit = Kit::find($request->kit);
        if ($kit->isAvailable($request->start_date)) {
            return redirect()->back()->with(['kitsForBooking' => Kit::where('id', $request->kit)->get(), 'availableDate' => $request->start_date]);
        }

        /*
         * The item is already booked
         * */
        Session::flash('error', 'The item is already booked on ' . $request->start_date);
        return redirect()->back();
    }
}
