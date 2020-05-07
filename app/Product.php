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

    public function kit(){
        return $this->belongsToMany(KitProduct::class);
    }

    /*
     * Gets all the items that are not in a kit and are active
     *
     * @return Products Collection.
     * */
    public static function getAvailableProducts(){
            return DB::table('products')->select('products.id', 'products.title', 'products.serial_number')
                                        ->join('kit_product','products.id','=', 'kit_product.product_id', 'left outer')
                                        ->orWhereNull('kit_product.product_id')
                                        ->where('products.status', 1)
                                        ->get();
    }
}
