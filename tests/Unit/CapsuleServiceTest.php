<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Mockery;
use App\Services\CapsuleContract;
use App\Dtos\PartyDto;
use App\Dtos\PartyDtoEmailAddressTypes;
use App\Jobs\CreatePartyJob;

class CapsuleServiceTest extends TestCase
{

    protected $capsuleService;

    public function setup():void
    {
        parent::setUp();
        $this->capsuleService = app()->make(CapsuleContract::class);
    }

    /**
     * Test Create Party Functionality
     *
     * @return void
     */
    public function testCreateParty()
    {
        $this->expectsJobs(CreatePartyJob::class);
        $partyDto = PartyDto::fromArray([
                                            "firstName" => "charles",
                                            "emailAddresses" => [
                                                [
                                                    "type" => PartyDtoEmailAddressTypes::HOME,
                                                    "address" => "abc@gmail.com"
                                                ]
                                            ]
                                        ]);
        $this->capsuleService->createParty($partyDto);
    }
}
