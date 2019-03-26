<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{

    protected $fillable = ['title', 'description', 'expires_at'];

    /**
     * Creates the expiry date for the reason
     *
     * @param $data
     * */
    public function setExpiry($data)
    {

        //Explode the string
        $string = explode('-', $data);
        $currentMonth = date('m');

        //Check if the course is a half credit
        if (stripos($string[1], 'H')) {

            //Check if its a winter course
            if (stripos($string[sizeof($string) - 1], 'W') > -1) {

                //Check if the winter course was added during winter other wise its for next year
                ($currentMonth >= 1 && ($currentMonth) <= 4) ? $this->expires_at = date('Y-04-30') :
                    $this->expires_at = date('Y') + 1 . date('-04-30');
            } else { //Its a fall course

                //Add the course in the current semester
                $this->expires_at = date('Y-12-31');

            }
        } else if (strpos($string[1], 'Y')) {

            //Check the appropriate date to set the user.
            ($currentMonth >= 9 && $currentMonth <= 12) ? $this->expires_at = date('Y') + 1 . date('-04-30') :
                $this->expires_at = date('Y-04-30');

        }
    }

    /*
     * Calculate the expiry of the reason
     *
     * @param $data
     * */
    public function createReason($data)
    {
        $this->title = $data;
        $this->setExpiry($data);
        $this->description = $data;
    }

    public function isUnique($title)
    {
        return ($this->where('title', $title)->first()) ? false : true;
    }
}
