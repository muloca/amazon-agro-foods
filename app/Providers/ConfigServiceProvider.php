<?php

namespace App\Providers;

use App\Helpers\ConfigHelper;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('confighelper', function () {
            return new ConfigHelper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Registrar funções globais
        if (!function_exists('config_helper')) {
            function config_helper($key = null, $default = null) {
                if ($key === null) {
                    return app('confighelper');
                }
                return app('confighelper')->get($key, $default);
            }
        }
    }
}
