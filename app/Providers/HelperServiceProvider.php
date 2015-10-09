<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Loads custom helper files
 * @package App\Providers
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Load helper classes from /app/Helpers
     *
     * @return void
     */
    public function register()
    {
        // Find each php file in /Helpers and load them
        foreach (glob(app_path().'/Helpers/*.php') as $helper) {
            require $helper;
        }
    }
}
