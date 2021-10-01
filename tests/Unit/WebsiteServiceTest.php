<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\WebsiteContract;
use Illuminate\Support\Facades\Hash;

class WebsiteServiceTest extends TestCase
{

    use RefreshDatabase;

    protected $websiteService;

    public function setup():void
    {
        parent::setUp();
        $this->websiteService = app()->make(WebsiteContract::class);
    }

    /**
     * Test Find All functionality on Website service 
     *
     * @return void
     */
    public function testFindAll(){
        // Todo
    }

    /**
     * Test Destroy functionality on Website service 
     *
     * @return void
     */
    public function testDestroy(){
        // Todo
    }

    /**
     * Test CreateOrUpdate functionality on Website service 
     *
     * @return void
     */
    public function testCreateOrUpdate(){
        // Todo
    }

    /**
     * Test Get Website With Id Or Slug or Domain functionality on Website service 
     *
     * @return void
     */
    public function testGetWebsiteWithIdOrSlugOrDomainQuery(){
        // Todo
    }
    
}


