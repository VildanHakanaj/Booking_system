<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
     * Gets the kit where the products is
     *
     * @return \App\Kit
     * */
    public function kit(){
        return $this->belongsTo('\App\Kit');
    }

}
