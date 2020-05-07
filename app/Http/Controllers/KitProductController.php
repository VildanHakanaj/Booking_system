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

        return view('admin.kits.kitProduct.create',
            [
                'kit' => $kit,
                'products' => Product::getAvailableProducts()
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        //Validate
        $data = $request->validate([
            'kit_id' => 'required',
            'product_id' => 'required'
        ]);

        if($kit = KitProduct::where('product_id', $data['product_id'])->count() > 0){
            Session::flash('error', 'The product is already assigned to a kit');
            return redirect()->route('kits.show', $data['kit_id']);
        }

        KitProduct::firstOrCreate($data);
        
        Session::flash('success', 'The product was added to the kit');
        return redirect()->route('kits.show', $data['kit_id']);
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
