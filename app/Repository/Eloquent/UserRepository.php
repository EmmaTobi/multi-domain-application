<?php

namespace App\Repository\Eloquent;

use App\User;

class UserRepository extends BaseRepository{

    /**
     * UserRepository Constructor
     * 
     * @param User $user the user model
     */
    public function __construct(User $user)
    {
       parent::__construct($user);
    }

}

?>