<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReasonToBook extends Model
{

    protected $table = 'reason_to_book';

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
        return (!$this->where('user_id', $user_id)->where('reason_id', $reason_id)->first())? true : false;
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
}
