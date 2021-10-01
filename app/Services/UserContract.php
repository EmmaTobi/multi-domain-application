<?php

namespace App\Services;

use App\User;

interface UserContract {

    /**
     * Create a user
     * @param $data array An array containing user informations
     * @return User|null
     */
    public function createUser(array $data): ?User;
    /**
     * Get a user websites
     * @param $user App\User
     * @return Collection
     */
    public function getWebsites(User $user): Collection;

}

?>

