<?php

namespace App\Providers;

use App\Settings\Settings;
use App\Userconfig\Userconfig;
use Illuminate\Support\ServiceProvider;
use App\PostProcessor\PostProcessor;
use App\PostProcessor\FilterYoutube;
use App\PostProcessor\FilterCensor;
use App\PostProcessor\FilterCleanHTML;
use App\PostProcessor\FilterMarkdown;
use App\PostProcessor\FilterSmilies;
use Illuminate\View\Compilers\BladeCompiler;

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
            FilterYoutube::class,
            FilterCensor::class,
            FilterCleanHTML::class,
            FilterMarkdown::class,
            FilterSmilies::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load user config.
        $this->app['userconfig'] = new Userconfig(base_path('userconfig/config.json'));
    }
}
