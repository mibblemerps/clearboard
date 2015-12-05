<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\PostProcessor\PostProcessor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Init the post processor
        PostProcessor::init();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
