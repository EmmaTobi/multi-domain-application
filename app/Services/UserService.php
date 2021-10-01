<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Collection;

class UserService implements UserContract{
    
    /** var  CapsuleService */
    protected $capsuleService;

    /** var  UserRepository */
    protected $userRepository;

    public function __construct(CapsuleContract $capsuleService, UserRepository $userRepository)
    {
        $this->capsuleService = $capsuleService;
        $this->userRepository = $userRepository;
    }

    /**
     * Create a user
     * @param $data array An array containing user informations
     * @return User|null
     */
    public function createUser(array $data): ?User{
        if(isset($data['name']) && isset($data['email']) && isset($data['password'])){
            $data = [
                'name' => $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['password']),
                ];
            return $this->userRepository->create($data);
        }
        return null;
    }

    /**
     * Get a user websites
     * @param $user App\User
     * @return Collection
     */
    public function getWebsites(User $user): Collection {
        return $user->websites;
    }

}

?>