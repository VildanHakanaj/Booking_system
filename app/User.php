<?php

namespace App;

use App\Notifications\VerifyBooking;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;
use App\Traits\ParseRosterFile;
use DB;

class User extends Authenticatable
{
    use Notifiable, ParseRosterFile;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function reasons()
    {
        return $this->belongsToMany(Reason::class, 'reason_to_book');
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

    public function toggleAdmin($value)
    {
        $this->admin = $value ? 1 : 0;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function deactivate()
    {
        ReasonToBook::where('user_id', $this->id)->update(['active' => 0]);
    }
    
    public static function search($query_param)
    {
        return  User::latest()
            ->where('name', 'LIKE', '%' . $query_param . '%')
            ->orWhere('email', 'LIKE', '%' . $query_param . '%')
            ->paginate(10);
    }


    public function addReasonForNewUser($reason)
    {
        $this->addReasonToBook([Reason::default()->id, Reason::where('title', $reason)->first()->id]);
    }

    public function addReasonToBook($reasons)
    {
        $this->reasons()->sync($reasons);
    }
}
