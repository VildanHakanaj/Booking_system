<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    /*
     * Get all the products in the kit
     *
     * */
    public function products(){

        return $this->hasMany('\App\Product');

    }

}
