<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use App\Utils\CapsuleRestTemplate;
use App\Services\CapsuleContract;
use App\Services\CapsuleService;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;

class CapsuleServiceProvider extends ServiceProvider
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
         // Bind concrete implementation of Alias HttpClient
        $this->app->bind("HttpClient", function ($app){
            $stack = HandlerStack::create();
            $stack->push(GuzzleRetryMiddleware::factory());
            return new Client(['handler' => $stack]);
        });

        // Bind concrete implementation of CapsuleRestTemplate
        $this->app->bind(CapsuleRestTemplate::class, function ($app){
            return new  CapsuleRestTemplate( config("app.capsule_api_token"), config("app.capsule_base_url") );
        });

        // Bind concrete implementation of CapsuleContract
        $this->app->bind(CapsuleContract::class, function ($app){
            return new CapsuleService();
        });

        
    }
}
