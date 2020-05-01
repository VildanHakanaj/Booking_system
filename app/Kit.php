<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use DB;

class Kit extends Model
{


    protected $guarded = [];

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
     * Gets the booking that it belongs to
     * @return Booking Model
     * */
    public function booking(){
        return $this->hasOne(Booking::class);
    }


    /*
     * Gets all the available kits for that date
     * @param start date
     * @return Kit all available collection
     * */
    public function allAvailable($start_date){
        return $this->whereNotIn('id', function($query) use ($start_date){
                $query->select('bookings.kit_id')
                    ->from('bookings')
                    ->where('start_date', '=', $start_date);
        })->get();
    }

    /*
     * Check if the kit is available for that day and is not booked
     *
     * @param $start_date
     * @return boolean
     * */
    public function isAvailable($start_date){
       $count = Booking::where('kit_id', '=', $this->id)->where('start_date', '=', $start_date)->count();
       return $count == 0 ? true : false;
    }

    public function getAvailableDates(){
        return Calendar::whereNotIn('date', function($query){
            $query->select('bookings.start_date')
                ->from('bookings')
                ->where('bookings.kit_id', '=', $this->id);
        })->get();
    }


    //Get all the kits that are available for booking
    public static function available(){
        return Kit::where('status', '=', 1)->get();
    }
}
