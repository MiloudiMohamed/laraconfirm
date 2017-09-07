<?php

namespace Devmi\Laraconfirm;

use Illuminate\Support\ServiceProvider;

class LaraconfirmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'Laraconfirm');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('\Devmi\Laraconfirm\Http\EmailConfirmationController');
    }
}
