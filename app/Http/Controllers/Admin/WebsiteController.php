<?php

namespace App\Http\Controllers\Admin;

use App\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

/**
 * Controller Handling requests related to websites
 */
class WebsiteController extends Controller
{

    /** var  WebsiteService */
    protected $websiteService;

    /**
     * WebsiteController Constructor
     * @param WebsiteService $websiteService
     */
    public function __construct(WebsiteService $websiteService)
    {
        $this->middleware(['auth', 'verified']);
        $this->websiteService = $websiteService;
    }

    /**
     * Show the list of user's websites
     * @return \Illuminate\View\View 
     */
    public function index(){
        $websites = $this->websiteService->findAll(auth()->user());
        return view('admin.website.index', compact('websites'));
    }

    /**
     * Show the form for creating a new website
     * @return \Illuminate\View\View 
     */
    public function create()
    {
        $website = app()->make(Website::class);
        $website->user_id = auth()->user()->id;
        return $this->edit($website);
    }

    /**
     * Show the form for editing the specified website
     * @param Website $website
     * @return \Illuminate\View\View 
     */
    public function edit(Website $website){
        if($website->user_id != auth()->user()->id){
            return abort(401);
        }

        return view('admin.website.edit', compact('website'));
    }

    /**
     * Delete the specified website
     * @param Website $website
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Website $website)
    {
        if($website->user_id != auth()->user()->id){
            return abort(401);
        }

        $websites = $this->websiteService->destroy($website);

        return redirect()
            ->route('website.index')->with('status', 'Website has been deleted successfully');
    }

    /**
     * Save a newly created website
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */ 
    public function store(Request $request){

        $website = app()->make(Website::class);
        $website->user_id = auth()->user()->id;

        return $this->update($request, $website);
    }

    /**
     *  Update the specified website
     * @param Request $request
     * @param Website $website
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Website $website){

        if($website->user_id != auth()->user()->id){
            return abort(401);
        }

        $request->validate([
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'domain' => 'sometimes|nullable|unique:websites,domain,' . $website->id
        ]);

        $website = $this->websiteService->createOrUpdate($website, $request);

        $message = $website->id ? 'Website has been updated successfully' : 'Website has been created successfully';

        return redirect()
                ->route('website.index')
                ->with('status', $message);
    }
}
