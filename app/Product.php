<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];


    public static function search($parameter){
        return Product::orderBy('created_at', 'desc')->where('title', 'LIKE', '%' . $parameter . '%')
            ->orWhere('brand', 'LIKE', '%' . $parameter . '%')
            ->orWhere('serial_number', 'LIKE', '%' . $parameter . '%')
            ->paginate(10);
    }

    /**
     * Set the status of the value
     * @param $value
     * */
    public function setStatusAttr($value)
    {
        $this->status = $value ? $this->status = 1 : $this->status = 0;
    }

    /**
     * Create the product model
     *
     * @params Request $request
     * */
    // public function createProduct(Request $request)
    // {
    //     $this->title = $request->title;
    //     $this->brand = $request->brand;
    //     $this->desc = $request->desc;
    //     $this->serial_number = $request->serial_number;
    //     $this->setStatusAttr($request->status);
    //     //Set all the nullable attributes only if they are set
    //     $this->setAttr([
    //         'serial_number' => $request->serial_number,
    //         'notes' => $request->notes,
    //         'maintenance' => $request->maintenace
    //     ]);
    // }

    public function kit(){
        return $this->belongsTo('App\KitProduct', 'product_id', 'id');
    }

    /*
     * Gets all the items that are not in a kit and are active
     *
     * @return Products Collection.
     * */
    public function getAvailableProducts(){
            return DB::table('products')->select('products.id', 'products.title', 'products.serial_number')
                                        ->join('kit_product','products.id','=', 'kit_product.product_id', 'left outer')
                                        ->orWhereNull('kit_product.product_id')
                                        ->where('products.status', 1)
                                        ->get();
    }
}
