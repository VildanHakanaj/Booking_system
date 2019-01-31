<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{

    /**
     *
     * Finds if the course is a full year or half year
     *
     * @return integer
     * -1 if no type is found
     * 1 if the type is full year
     * 0 if the type is half year
     *
     * */
    public function typeOfCourse($string){

        //Explode the course title
        $data = explode('-', $string);
        //Find if the course number has a y or h at the end
        if(strpos($data[1], 'Y')){
            return 1;
        }elseif(strpos($data[1], 'H')){
            return 0;
        }

        return -1;
    }
}
