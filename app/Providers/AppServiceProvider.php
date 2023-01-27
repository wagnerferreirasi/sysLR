<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Client::observe(\App\Observers\ClientObserver::class);
        Route::observe(\App\Observers\RouteObserver::class);
    }
}
