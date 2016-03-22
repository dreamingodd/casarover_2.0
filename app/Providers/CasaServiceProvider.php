<?php

namespace App\Providers;

use App\Services\CasaService;
use Illuminate\Support\ServiceProvider;

class CasaServiceProvider extends ServiceProvider
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
        $this->app->singleton('CasaService', function(){
            return new CasaService();
        });
    }
}
