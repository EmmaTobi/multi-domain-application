<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Dtos\PartyDto;
use App\Utils\CapsuleRestTemplate;


class CreatePartyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $partyDto;

    public $timeout = 1200;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PartyDto $partyDto)
    {
        $this->partyDto = $partyDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CapsuleRestTemplate $capsuleRestTemplate)
    {
        $partyDto = $capsuleRestTemplate->post($this->partyDto);
        \Log::info("Party with name ". $partyDto->getFirstname() ."was created succesfully");
    }
}
