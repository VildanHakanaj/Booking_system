<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{

    protected $fillable = ['title', 'description', 'expires_at'];

    public function users(){
        return $this->belongsToMany(User::class, 'reason_to_book');
    }

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

    public function isUnique($title){
        return ($this->where('title', $title)->first()) ? false : true;
    }

    public function isActiveForUser(User $user){

         return ReasonToBook::where('user_id', $user->id)->where('reason_id', $this->id)->first()->active == 1;
    }

    public static function search($query_param){
        return Reason::latest()->where('title', 'LIKE', '%' . $query_param . '%')
        ->orWhere('title', 'LIKE', '%' . $query_param . '%')
        ->paginate(10);       
    }
}
