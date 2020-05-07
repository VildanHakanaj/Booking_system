<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', 
            [
                'products' => Product::orderBy('created_at', 'desc')->paginate(10)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the request
        $data = $request->validate([
            'title' => 'required|unique:products|min:2|max:255',
            'brand' => 'required|min:2|max:255',
            'desc' => 'required|min:5',
            'serial_number' => 'nullable|min:2|max:255',
        ]);

        $product = Product::create($data);
        Session::flash('success', 'Product was inserted successfully');
        return redirect()->route('products.show', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', 
            [
                'product' => $product
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', 
            [
                'product' => $product
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //validate the request
        $data = $request->validate(
            [
                'title'             => 'required|min:2|max:255',
                'brand'             => 'required|min:2|max:255',
                'desc'              => 'required|min:2|max:255',
                'serial_number'     => 'nullable|min:5|max:255',
                'notes'             => 'nullable|min:2|max:255',
                'maintenance'       => 'nullable|date|min:2|max:255',
            ]
        );
        $product->setStatusAttr($request->status);
        $product->update($data);
        Session::flash('success', 'Product was successfully updated');
        return redirect()->route('products.show', $product->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
    }

    public function search(Request $request){

        if(empty($request->search)){
            return view('admin.products.index', 
            [
                'products' => Product::latest()->paginate(10)
            ]
        );
        }

        return view('admin.products.index', 
            [
                'products' => Product::search($request->search)
            ]
        );

    }
}
