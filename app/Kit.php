<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kit extends Model
{

    /**
     *TODO
     * [ ] Create a kit
     *
     * */
    protected $fillable = ['title'];

    /**
     * Get the kit that it belongs
     *
     * @return BelongsTo
     * */
    public function kit(){
        return $this->belongsTo(\App\Bookable_kit::class);
    }

}
