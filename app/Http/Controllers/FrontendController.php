<?php

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;
use App\Services\WebsiteService;

class FrontendController extends Controller
{
    /** var  WebsiteService */
    protected $websiteService;

    /**
     * FrontendController Constructor
     * @param App\Services\WebsiteService $websiteService
     */
    public function __construct(WebsiteService $websiteService)
    {
        $this->middleware(['auth', 'verified']);
        $this->websiteService = $websiteService;
    }
    
    /**
     * Show website
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\RedirectResponse|\Illuminate\View\View 
     */
    public function show(Request $request){
        $subdomain = $request->route('domain') ?? $request->route('subdomain');
        $website = $this->websiteService->getWebsiteWithIdOrSlugOrDomainQuery($subdomain);
        if($website)
            return view('frontend.show', compact('website'));
        return redirect()->back()->with(["status" => "error", "message" => "Website not found"]);
    }
}
