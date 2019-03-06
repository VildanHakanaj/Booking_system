<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'title',
        'brand',
        'desc',
        'serial_number',
        'status',
        'notes',
        'maintenance',
    ];

    /*
     * Gets the kit where the products is
     *
     * @return \App\Kit
     * */
    public function kit(){
        return $this->belongsTo('\App\Kit');
    }

    /**
     * Set the status of the value
     *
     * */
    public function setStatusAttr($value){
        if($value){
            $this->status = 1;
        }else{
            $this->status = 0;
        }
    }

    public function createProduct(Request $request){
        $this->title         = $request->title;
        $this->brand         = $request->brand;
        $this->desc          = $request->desc;
        $this->serial_number = $request->serial_number;
        $this->notes         = $request->notes;
        $this->maintenance   = $request->maintenance;

    }
}
