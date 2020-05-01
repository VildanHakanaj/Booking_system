<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitProduct extends Model
{
    protected $guarded = [];
    protected $table = 'kit_product';

    public function products(){
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
    /**
     * Get the kit
     * */
    public function kit(){
        return $this->hasOne('App\Kit', 'id', 'kit_id');
    }

}
