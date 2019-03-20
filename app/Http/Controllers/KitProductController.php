<?php

namespace App\Http\Controllers;

use App\KitProduct;
use App\Product;
use Illuminate\Http\Request;
use App\Kit;
use Session;

class KitProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kit $kit){
        $product = new Product();
        $products = $product->getAvailableProducts();
        return view('admin.kits.kitProduct.create')->with('kit', $kit)->with('products', $products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $kitProduct = new KitProduct();
        //Validate
        $request->validate([
            'kit_id' => 'required',
            'product_id' => 'required'
        ]);
        //Create the kit object
        $kitProduct->kit_id     = $request->kit_id;
        $kitProduct->product_id = $request->product_id;

        //Check if the product exists in the kit.
        //Just to make sure that the user doesn't do anything
        if(KitProduct::where('kit_id', $kitProduct->kit_id)->where('product_id', $kitProduct->product_id)->count() == 0){
            //save the product
            $kitProduct->save();
            Session::flash('success', 'The product was added to the kit');

            return redirect()->route('kits.show', $kitProduct->kit_id);
        }

        //In case the user has entered the same product in the kit
        Session::flash('error', 'The product already exists');
        return redirect()->route('kits.show', $kitProduct->kit_id);
    }

    public function removeAll(Kit $kit){
        KitProduct::where('kit_id', $kit->id)->delete();
        Session::flash('success', 'Removed all the products from the kit');
        return redirect()->route('kits.show', $kit->id);
    }

    /*
     * Removes a single product from the kit
     *
     * @params Product $product to be removed.
     * */
    public function removeProduct(Product $product){
        KitProduct::where('product_id', $product->id)->delete();
        Session::flash('success', 'Removed ' . $product->title . ' from kit');
        return redirect()->back();
    }

}
