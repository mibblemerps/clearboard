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
        Blade::directive('hasperm', function ($expression) {
            return "<?php if (Auth::user()->can({$expression})): ?>";
        });

        Blade::directive('missingperm', function ($expression) {
            return "<?php if (!Auth::user()->can({$expression})): ?>";
        });

        Blade::directive('endperm', function ($expression) {
            return '<?php endif; ?>';
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
