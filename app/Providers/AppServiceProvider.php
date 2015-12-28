<?php

namespace App\Providers;

use App\Settings\Settings;
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
        $this->app['postprocessor'] = new PostProcessor([
            \App\PostProcessor\FilterYoutube::class,
            //\App\PostProcessor\FilterCensor::class,
            \App\PostProcessor\FilterCleanHTML::class,
            \App\PostProcessor\FilterMarkdown::class,
            \App\PostProcessor\FilterSmilies::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Init the settings class
        $this->app['settings'] = new Settings();
    }
}
