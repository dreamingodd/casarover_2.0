<?php

namespace App\Providers;

use App\Services\VcRelationService;
use Illuminate\Support\ServiceProvider;

class VcRelationServiceProvider extends ServiceProvider
{
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
        $this->app->singleton('VcRelationService', function(){
            return new VcRelationService();
        });
    }
}
