<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserContract;
use Illuminate\Support\Facades\Hash;

class UserServiceTest extends TestCase
{

    use RefreshDatabase;

    /** @var UserContract */
    protected $userService;

    public function setup():void
    {
        parent::setUp();
        $this->userService = app()->make(UserContract::class);
    }

    /**
     * Test Create User functionality on User service 
     *
     * @return void
     */
    public function testCreateUser()
    {
        $data = [
            "name" => "emmanuel",
            "email" => "emmanuel@gmail.com",
            "password" => Hash::make('password')
        ];
        $user = $this->userService->createUser($data);
        $this->assertEquals($user->getName(),  $data["name"]);
        $this->assertEquals($user->getEmail(),  $data["email"]);
        $this->assertNotNull($user->getId());

        $data = [
            "name" => null,
            "email" => null,
            "password" => null
        ];
        
        $user = $this->userService->createUser($data);
        $this->assertNull($user);

        $data = [];
        $user = $this->userService->createUser($data);
        $this->assertNull($user);

    }

}


