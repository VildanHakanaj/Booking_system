<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user(){

        return $this->belongsTo(User::class);

    }

    public function kit(){

        return $this->belongsTo(Kit::class);

    }
}
