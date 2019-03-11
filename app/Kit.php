<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;


class Kit extends Model
{

    /**
     *TODO
     * [ ] Create a kit
     *
     * */


    public function setCheckedAttribute($input, $value){
        $this->$input = $value == "on" ? 1 : 0;

    }


    public function createKit(Request $request){
        $this->title            = $request->title;
        $this->booking_window   = $request->booking_window;
        $this->setCheckedAttribute('back_to_back', $request->back_to_back);
        $this->setCheckedAttribute('status', $request->status);
    }


}
