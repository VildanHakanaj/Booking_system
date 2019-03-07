<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{

    /**
     *TODO
     * [ ] Create a kit
     *
     * */

    /*
     * Get all the products in the kit
     *s
     * @return \App\Product
     * */
    public function products(){
        return $this->hasMany('\App\Product');
    }
}
