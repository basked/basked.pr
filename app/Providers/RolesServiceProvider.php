<?php

namespace App\Providers;

use  Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Traits\HasRolesAndPermissions;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('basket', function ($expression) {
            return "<?php echo ($expression); ?>";
        });
        Blade::if('role', function ($role) {
            return (auth()->check() && auth()->user()->hasRole($role));
        });
    }
}
