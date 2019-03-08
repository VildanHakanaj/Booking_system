<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bookable_kit extends Model
{


    /**
     * Get all the product in this kit
     *
     * @return HasMany
     * */
    public function products(){
        return $this->hasMany(\App\Product::class);
    }

    /**
     * Gets the kit where it is
     *
     * @return HasOne
     * */
    public function kit(){
        return $this->hasOne(\App\Product::class);
    }

}
