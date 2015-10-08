<?php

namespace App\Providers;

use app\Themes\ThemeNotFoundException;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Setup themes
        $theme = config('clearboard.theme'); // current theme
        if (is_dir(base_path("themes/$theme")))
        {
            // Add theme view directory as a views location
            $this->app['view']->addLocation(base_path("themes/$theme/views"));
        } else {
            // Theme does not exist!
            throw new ThemeNotFoundException();
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
