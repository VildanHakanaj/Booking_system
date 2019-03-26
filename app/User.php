<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;
use mysql_xdevapi\Collection;
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
     * Add the user data into the user
     *
     * @param $data
     * */
    public function createUser($data)
    {
        $this->stdn = $data['stdn'];
        $this->name = $data['name'];
        $this->email = $data['email'];
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

    /**
     * Get all the reasons associated with the user
     * @return HasMany
     *
     * */
    public function reasons()
    {
        return DB::table('reason_to_book')
            ->select('reason_to_book.active', 'reasons.title', 'reasons.id')
            ->join('reasons', 'reason_to_book.reason_id',  '=' , 'reasons.id')
            ->where('user_id', $this->id)->get();
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


}
