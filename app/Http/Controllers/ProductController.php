<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{

    /**
     *TODO
     * [ ] Ask the user if the item will be bookable to itself or a kit
     * [ ] Use js to add the disabled choice when the user checks the box
     * [ ] Then set the product to a kit
     * [ ] Only show existing kits if the user will select to choose with other kits
     * [ ] Dont force the user to place the product in a kit right away
     * [ ] If the product is in a kit create a function to differentiate if a product is in a kit already
     * [ ] If the product is not in a kit dont make them to be bookable
     * [ ] Allow the admin to change the status of the kit
     * [ ] Allow the admin to change the kit for a product
     *      [ ] You can allow the admin to move the product into another kit
     *          [ ] Delete the product from the current kit and just add it in the second kit.
     *
     * */

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
        //Get all the products
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index')->with('products', $products);
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
        $product = new Product();
        //validate the request
        $request->validate([
            'title' => 'required|unique:products|min:2|max:255',
            'brand' => 'required|min:2|max:255',
            'desc' => 'required|min:5',
            'serial_number' => 'required|min:2|max:255',
        ]);
        $product->createProduct($request);
        //Add the product
        $product->save();

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
        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product', $product));
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
        $request->validate(
            [
                'title'             => 'required|min:2|max:255',
                'brand'             => 'required|min:2|max:255',
                'desc'              => 'required|min:2|max:255',
                'serial_number'     => 'nullable|min:5|max:255',
                'notes'             => 'nullable|min:2|max:255',
                'maintenance'       => 'nullable|date|min:2|max:255',
            ]
        );


        /*
         *FIXME::
         * [ ] The update will throw error if the checkbox is checked because is not an integer
         *
         * */

        //Creates the product
        $product->createProduct($request);

        //Set the status attribute
        $product->setStatusAttr($request->status);

        //Update the model
        $product->update();

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
        //
    }
}
