<?php

namespace App\Services;

use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Dtos\PartyDto;
use App\Jobs\CreatePartyJob;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendSignUpNotification;

class CapsuleService implements CapsuleContract{

    use DispatchesJobs;

    public function createParty(PartyDto $partyDto) {
       $this->dispatch( new  CreatePartyJob( $partyDto) ) ;
    }

    /**
     * Notifies app sales head of a newly signedup user
     * @param $user User the newly signup user
     * @return void
     */
    public function notifySalesHeadOfNewUserSignup(User $user) {
      $delay = now()->addMinutes(2); //number of minutes to wait before notificaion is sent
      Notification::route('mail', config("app.capsule_sales_head_default_email"))->notify( (new SendSignUpNotification($user))->delay($delay) );
   }

}

?>

