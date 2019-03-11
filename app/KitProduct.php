<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitProduct extends Model
{
    protected $table = 'kit_product';
    /*
     * Get the products
     * */
    public function products(){
        return $this->hasMany(Product::class);
    }

    /**
     * Get the kit
     * */
    public function kit(){
        return $this->hasOne(Kit::class);
    }

}
