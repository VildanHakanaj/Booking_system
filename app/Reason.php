<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    //functions go here

    public function setExpiry($data){

        $string = explode('-', $data);

        //Check if the course is a half credit
        if(stripos($string[1], 'H')){

            //Check if its a winter course
            if(stripos($string[sizeof($string) - 1], 'W') > -1){

                //Check if the user is added during winter for a winter course
                if((date('m')) > 1 && (date('m')) <= 4){

                    //Set the current date
                    $this->expires_at = date('Y-04-31');

                }else{

                    //Add the course for the next year
                    $this->expires_at = date('Y') + 1 . "-" . date('04-31');
                    echo "Fall";
                    dd($this->expires_at);
                }
            }else{

                //Add the course in the current semester
                $this->expires_at = date('Y-12-31');
                dd($this->expires_at);
            }

        }else if(strpos($string[1], 'Y')){
            if(date('m') > 2 && date('m') <= 12){
                $this->expires_at = date('Y') + 1 . date('-04-31');
                dd( "Full year added in fall" . $this->expires_at);
            }else{

                $this->expires_at = date('Y-04-31');
                dd('Full year added in winter' . $this->expires_at);

            }

        }

    }

}
