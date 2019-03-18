<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    /**
     * Set the status of the value
     * @param $value
     * */
    public function setStatusAttr($value)
    {
        $this->status = $value ? $this->status = 1 : $this->status = 0;
    }


    /**
     * Set the attributes if they are not null
     * @params array
     * */
    public function setAttr($arr)
    {
        foreach ($arr as $input => $value) {
            if (!is_null($value)) {
                $this->$input = $value;
            }
        }
    }

    /**
     * Create the product model
     *
     * @params Request $request
     * */
    public function createProduct(Request $request)
    {
        $this->title = $request->title;
        $this->brand = $request->brand;
        $this->desc = $request->desc;
        $this->serial_number = $request->serial_number;
        $this->setStatusAttr($request->status);
        //Set all the nullable attributes only if they are set
        $this->setAttr([
            'serial_number' => $request->serial_number,
            'notes' => $request->notes,
            'maintenance' => $request->maintenace
        ]);
    }

    public function kit(){
        return $this->belongsTo('App\KitProduct', 'product_id', 'id');
    }

    public function getAvailableProducts(){
        return $this->where('status', 1)->orderBy('created_at', 'desc')->get();
    }

}
