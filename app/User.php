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

    /**
     * One user has one reason_to_book
     *
     * */

//    public function reasonToBook(){
//
//       return  $this->hasOne();
//
//    }


    /**
     * Checks if the user is an admin or not
     *
     * @return boolean
     * */
    public function isAdmin(){
        return $this->admin == 1 ? true : false;
    }

    /**
     * Checks if the user has completed the registration
     *
     * @return boolean
     *
     * */
    public function verified(){
        return $this->token == null;
    }

    /**
     *
     * Sends the user the email to complete registration
     *
     *
     * */
    public function sendVerificationEmail(){
        $this->notify(new VerifyEmail($this));
    }

    /**
     *  parses the file and extracts all the data from the file
     *
     *  @return array
     *
     *TODO
     * [ ] Figure how to get the file from the computer
     */
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
        return [$userRoster, $reason];
    }

    public function createUser($data){
        $this->stdn     = $data['stdn'];
        $this->name     = $data['name'];
        $this->email    = $data['email'];

    }


}
