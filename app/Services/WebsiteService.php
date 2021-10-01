<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Website;
use Illuminate\Support\Collection;

class WebsiteService implements WebsiteContract {

    /** @var UserService */
    protected $userService;

    /** @var WebsiteRepository */
    protected $websiteRepository;

    /**
     * WebsiteService Constructor
     * @param UserService $userService
     * @param WebsiteRepository $websiteRepository
     */
    public function __construct(UserService $userService,  WebsiteRepository $websiteRepository){
        $this->userService = $userService;
        $this->websiteRepository = $websiteRepository;
    }

    /**
     * Get All User Websites
     * @param User $user a user entiity
     * @return Collection
     */
    public function findAll(User $user) : Collection{
        return $this->userService->getWebsites($user);
    }

    /**
     * Delete a Website
     * @param Website $website A website entity
     * @return bool|null
     */
    public function destroy(Website $website) : ?bool {
        return $this->websiteRepository->destroyWebsite($website);
    }

    /**
     * Create or Update Website
     * @param Website $website A website entity
     * @param Request $data request data
     * @return bool|null
     */
    public function createOrUpdate(Website $website, Request $data) : ?bool{

        $website->domain = $data->input('domain');
        $website->name = $data->input('name');
        $website->slug =  $data->slug ?: Str::slug($data->input('name'), '-') . '-' . uniqid();
        $website->about = $data->input('about');
        $website->email = $data->input('email');
        $website->facebook = $data->input('facebook');
        $website->twitter = $data->input('twitter');

        if($data->file('avatar')) {
            $avatar = $data->file('avatar')->store('uploads', 'public');
            $website->avatar = $data;
        }

        return $this->websiteRepository->saveWebsite($website);
    }

    /**
     * Get website with Query by Id, Slug, or Domain
     * @param string $subdomain
     * @return Website|null
     */
    public function getWebsiteWithIdOrSlugOrDomainQuery(string $subDomain) : ?Website
    {
        return $this->websiteRepository->findWebsiteWithIdOrSlugOrDomainQuery($subDomain);
    }
}

?>

