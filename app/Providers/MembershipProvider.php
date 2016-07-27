<?php

namespace App\Providers;

use App\Services\MembershipService;
use Illuminate\Support\ServiceProvider;

class MembershipProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('MembershipService', function(){
            return new MembershipService();
        });
    }
}
