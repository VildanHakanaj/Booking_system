<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /*
     * Gets the kit where the products is
     *
     * @return \App\Kit
     * */
    public function kit()
    {
        return $this->belongsTo('\App\Kit');
    }

    /**
     * Set the status of the value
     * @param $value
     * */
    public function setStatusAttr($value)
    {
        $this->status = $value ? $this->status = 1 : $this->status = 0;
    }


    /**
     * Set the attributes if they are not null
     * @params array
     * */
    public function setAttr($arr)
    {
        foreach ($arr as $input => $value) {
            if (!is_null($value)) {
                $this->$input = $value;
            }
        }
    }

    /**
     * Create the product model
     *
     * @params Request $request
     * */
    public function createProduct(Request $request)
    {
        $this->title = $request->title;
        $this->brand = $request->brand;
        $this->desc = $request->desc;
        $this->serial_number = $request->serial_number;
        $this->setStatusAttr($request->status);
        //Set all the nullable attributes only if they are set
        $this->setAttr([
            'serial_number' => $request->serial_number,
            'notes' => $request->notes,
            'maintenance' => $request->maintenace
        ]);
    }
}
