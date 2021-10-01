<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Website;
use Illuminate\Support\Collection;

interface WebsiteContract {

    /**
     * Get All User Websites
     * @param User $user a user entiity
     * @return Collection
     */
    public function findAll(User $user) : Collection;

    /**
     * Delete a Website
     * @param Website $website A website entity
     * @return bool|null
     */
    public function destroy(Website $website) : bool;

    /**
     * Create or Update Website
     * @param Website $website A website entity
     * @param Request $data request data
     * @return bool|null
     */
    public function createOrUpdate(Website $website, Request $data) : bool;

}

?>

