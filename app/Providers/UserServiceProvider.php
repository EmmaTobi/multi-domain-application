<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserContract;
use App\Services\UserService;
use App\Services\CapsuleContract;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
