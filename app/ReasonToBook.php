<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReasonToBook extends Model
{

    protected $table = 'reason_to_book';

    /*
     *
     *TODO
     * [ ] Add the user relation to it
     * [ ] Create the relation
     * [ ] Show the relationr
     * [ ] index the relation
     * [ ] Create the relation of the user with the reason
     * Look Up
     * [ ] The relations of the user between the reason
     *  Question
     *      [ ] Should the admin change the relation
     *      [ ] Should the admin delete a relation
     *      [ ] Should the admin stop a relation
     * */

    public function createRelation($user, $reason){
        $this->user_id = $user->id;
        $this->reason_id = $reason->id;
        $this->save();
    }
}
