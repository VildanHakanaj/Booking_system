<?php

namespace App\Http\Controllers;

use App\Kit;
use Illuminate\Http\Request;

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
                'back_to_back' => 'min:2|max:255',
                'status' => 'min:2|max:255',
            ]
        );



        dd($request->all());
        /**
         *TODO
         * [ ] Create an empty kit first.
         * [ ] Create a function to one product at a time.
         * [ ] Look if you need to create it at the kit level
         * */

        return redirect()->route('kits.show')->with('kit', $kit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        dd("Show Kit");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kit $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        //
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
        //
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
}
