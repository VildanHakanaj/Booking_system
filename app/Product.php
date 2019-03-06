<?php

namespace App;

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

}
