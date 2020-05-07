<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = ['title', 'description', 'expires_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'reason_to_book');
    }

    public static function setExpiry($title)
    {
        //Explode the string
        $string = explode('-', $title);
        $currentMonth = date('m');
        $expires = "";
        //Check if the course is a half credit
        if (stripos($string[1], 'H')) {

            //Check if its a winter course
            if (stripos($string[sizeof($string) - 1], 'W') > -1) {

                //Check if the winter course was added during winter other wise its for next year
                ($currentMonth >= 1 && ($currentMonth) <= 4) ? $expires = date('Y-04-30') :
                    $expires = date('Y') + 1 . date('-04-30');
            } else { //Its a fall course

                //Add the course in the current semester
                $expires = date('Y-12-31');
            }
        } elseif (strpos($string[1], 'Y')) {

            //Check the appropriate date to set the user.
            ($currentMonth >= 9 && $currentMonth <= 12) ? $expires = date('Y') + 1 . date('-04-30') :
                $expires = date('Y-04-30');
        }

        return $expires;
    }

    public function isUnique($title)
    {
        return ($this->where('title', $title)->first()) ? false : true;
    }

    public function isActiveForUser(User $user)
    {
        return ReasonToBook::where('user_id', $user->id)->where('reason_id', $this->id)->first()->active == 1;
    }

    public static function search($query_param)
    {
        return Reason::latest()->where('title', 'LIKE', '%' . $query_param . '%')
        ->orWhere('title', 'LIKE', '%' . $query_param . '%')
        ->paginate(10);
    }

    public static function getDefaultReason()
    {
        return Reason::where('title', 'other')->first();
    }
}
