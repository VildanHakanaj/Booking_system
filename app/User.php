<?php

namespace App;

use App\Notifications\VerifyBooking;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;
use DB;

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
     * Checks if the user is an admin or not
     *
     * @return boolean
     * */
    public function isAdmin()
    {
        return $this->admin == 1 ? true : false;
    }

    /**
     * Checks if the user has completed the registration
     *
     * @return boolean
     *
     * */
    public function verified()
    {
        return $this->token == null;
    }

    /**
     *
     * Sends the user the email to complete registration
     *
     *
     * */
    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }

    /**
     *
     * Sends the user the email to verify booking
     *
     *
     * */
    public function sendBookingVerification($booking)
    {
        $this->notify(new VerifyBooking($this, $booking));
    }


    public function defaultReason(){
        $this->reasons()->create();
    }
    

    /**Check if the use is unique
     *
     * @param $email
     * @return boolean
     * */
    public function isUnique($email)
    {
        return ($this->where('email', $email)->first()) ? false : true;

    }

    public function reasons(){
        return $this->belongsToMany(Reason::class, 'reason_to_book')->get();
    }

    /**
     * Check if the user is active or not
     *
     * @return boolean
     * */
    public function isActive()
    { 
        if (!$this->isAdmin()) {
            return $this->reasons()->where('active', 1)->count() > 0;
        }
        return true;

    }

    public function toggleAdmin($value){
        $this->admin = $value ? 1 : 0;
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function deactivate(){
        ReasonToBook::where('user_id', $this->id)->update(['active' => 0]);
    }

    public static function search($query_param){
        return  User::latest()
            ->where('name', 'LIKE', '%' . $query_param . '%')
            ->orWhere('email', 'LIKE', '%' . $query_param . '%')
            ->paginate(10);
    }

}
