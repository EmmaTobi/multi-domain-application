<?php

namespace App\Repository\Eloquent;

use App\Website;

class WebsiteRepository extends BaseRepository{

    /**
     * WebsiteRepository Constructor
     * 
     * @param Website $website the website model
     */
    public function __construct(Website $website)
    {
       parent::__construct($website);
    }
 
    /**
     * Save a given website
     * @param Website $website
     * @return bool|null
     */
    public function saveWebsite(Website $website) : ?bool
    {
        return $website->save();
    }

    /**
     * Destroy a given website
     * @param Website $website
     * @return bool|null
     */
    public function destroyWebsite(Website $website) : ?bool
    {
        return $website->delete();
    }

    /**
     * Find website with Query by Id, Slug, or Domain
     * @param string $subdomain
     * @return Website|null
     */
    public function findWebsiteWithIdOrSlugOrDomainQuery(string $subdomain) : ?Website
    {
        return Website::where('id', $subdomain)
                        ->orWhere('slug', $subdomain)
                        ->orWhere('domain', $subdomain)
                        ->first();
    }

}

?>