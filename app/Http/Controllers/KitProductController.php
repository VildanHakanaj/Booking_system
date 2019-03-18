<?php

namespace App\Http\Controllers;

use App\KitProduct;
use App\Product;
use Illuminate\Http\Request;
use App\Kit;
use Session;

class KitProductController extends Controller
{
    public function create(Kit $kit){
        $product = new Product();
        $products = $product->getAvailableProducts();
        return view('admin.kits.kitProduct.create')->with('kit', $kit)->with('products', $products);
    }

    public function store(Request $request){
        /*
         *TODO
         * [x] Validate the request
         * [x] Check if the products or relationship doesnt exist
         * CASES
         * [ ] if the product is taken already
         *      [ ] Alert the user for this problem
         * [ ] If the product is free
         *      [ ] Allow the user to insert the product in this kit
         * FeedBack
         *
         * */

        $kitProduct = new KitProduct();

        $request->validate([
            'kit_id' => 'required',
            'product_id' => 'required'
        ]);


        $kitProduct->kit_id     = $request->kit_id;
        $kitProduct->product_id = $request->product_id;

//        dd(KitProduct::where('kit_id', $kitProduct->kit_id)->where('product_id', $kitProduct->product_id)->count());
        if(KitProduct::where('kit_id', $kitProduct->kit_id)->where('product_id', $kitProduct->product_id)->count() == 0){

            Product::where('id', $request->product_id)->update(['status' => 0]);
            $kitProduct->save();
            Session::flash('success', 'The product was added to the kit');
            return redirect()->route('kitProduct.create', $request->kit_id);

        }

        Session::flash('error', 'The product already exists');
        return redirect()->route('kitProduct.create', $request->kit_id);

    }
}
