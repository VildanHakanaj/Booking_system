<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'home_address', 'phone_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        return $this->admin == 1 ? true : false;
    }

    public function verified(){
        return $this->token == null;
    }

    public function sendVerificationEmail(){
        $this->notify(new VerifyEmail($this));
    }

    public function parseFile(){
        $handler = fopen('C:\Users\ahaka\OneDrive\Documents\Internship\Milestones\roster.csv', 'r');

        //Does the file have header
        $header = true;

        //Count for the empty rows
        $count = 0;

        //Parse the csv file.
        while($csvLine = fgetcsv($handler,  1000, ',')){
            if($header)
            {
                $count++;
                if($count == 2){
                    $header = false;
                }
            }else{
                $reason = [
                    'reason' => $csvLine[4],
                ];

                $userRoster = [
                    'stdn' => $csvLine[0],
                    'name' => $csvLine[1] . ' ' . $csvLine[2],
                    'email'=> $csvLine[3],
                ];
            }
        }
        return $userRoster;
    }

}
