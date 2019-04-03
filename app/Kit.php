<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use DB;

class Kit extends Model
{

    /*Get the kit product*/
    public function kitProduct(){
        return $this->belongsTo('App\KitProduct', 'id', 'kit_id');
    }

    /*
     * Get all products associated with this kit
     * @return Array of Products
     *
     * */
    public function products(){
        return DB::table('products')
            ->select('products.*')
            ->join('kit_product', 'kit_product.product_id',  '=' , 'products.id')
            ->where('kit_product.kit_id', $this->id)->get();
    }

    /*
     *
     * Set the attribute
     * @params $input $value
     *
     * */
    public function setCheckedAttribute($input, $value){
        $this->$input = $value == "on" ? 1 : 0;
    }

    /*
     *
     * Creates the kit model
     * @param Request
     *
     * */
    public function createKit(Request $request){
        $this->title            = $request->title;
        $this->booking_window   = $request->booking_window;
        $this->setCheckedAttribute('back_to_back', $request->back_to_back);
        $this->setCheckedAttribute('status', $request->status);
    }

    /*
     *
     * Gets the booking that it belongs to
     * @return Booking Model
     * */
    public function booking(){
        return $this->hasOne(Booking::class);
    }


    public function allAvailable($start_date){

    }
}
