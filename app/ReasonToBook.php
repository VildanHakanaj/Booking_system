<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReasonToBook extends Model
{

    protected $table = 'reason_to_book';
    protected $fillable = [
        'user_id',
        'reason_id'
    ];
    /**
     * Creates the relation between user and reason
     *
     * @param $user
     * @param $reason
     * */
    public function createRelation($user, $reason){
        $this->user_id = $user->id;
        $this->reason_id = $reason->id;
    }


    /**
     * Check if the relation doesn't exist already
     *
     * @param $user_id
     * $param $reason_id
     *
     * @return
     * */
    public function isUnique($user_id, $reason_id){

        return ($this->where('user_id', $user_id)->where('reason_id', $reason_id)->first()) ? false : true;

    }

    /**
     * Create the base relation to all the new users
     *
     * @param $user
     * @param $reason
     * */
    public function addDefault($user, $reason){
        $this->createRelation($user, $reason);
    }

    /*
     *TODO
     * [ ] Fix the relation between the reasons to book and the users.
     * */
    public function user(){

        $this->belongsTo('App\User');

    }

    public function toggleActive(){
        $this->active == 1 ? $this->active = 0 : $this->active = 1;
        $this->save();
    }
}
