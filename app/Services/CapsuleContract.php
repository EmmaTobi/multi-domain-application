<?php

namespace App\Services;

use App\Dtos\PartyDto;
use App\User;

interface CapsuleContract {

    public function createParty(PartyDto $partyDto);

    public function notifySalesHeadOfNewUserSignup(User $user);

}

?>

