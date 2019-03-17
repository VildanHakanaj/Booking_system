<?php

namespace App\Http\Controllers;

use App\Kit;
use App\KitProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kits = Kit::orderBy('created_at', 'desc')->paginate(10);
;
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
        //
    }

    public function search(Request $request){

        if(empty($request->search)){
            return view('admin.kits.index')->with('kits', Kit::orderBy('created_at', 'desc')->paginate(10));
        }

        $kits = Kit::orderBy('created_at', 'desc')->where('title', 'LIKE', '%' . $request->search . '%')->paginate(10);
        return view('admin.kits.index')->with('kits', $kits);

    }
}
