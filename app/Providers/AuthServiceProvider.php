<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Blade directive to check if user has permission node.
        Blade::directive('hasperm', function ($expression) {
            return "<?php if ((Auth::user() !== null) && Auth::user()->can({$expression})): ?>";
        });

        // Blade directive to see if user is missing permission node.
        Blade::directive('missingperm', function ($expression) {
            return "<?php if ((Auth::user() !== null) && !Auth::user()->can({$expression})): ?>";
        });

        // Blade directive to end permission node check block.
        Blade::directive('endperm', function ($expression) {
            return '<?php endif; ?>';
        });

        // Override @can, @cannot and @endcan to permission node checks.
        Blade::extend(function ($view) {
            $view = str_replace('@can', '@hasperm', $view);
            $view = str_replace('@cannot', '@missingperm', $view);
            $view = str_replace('@endcan', '@endperm', $view);
            return $view;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
