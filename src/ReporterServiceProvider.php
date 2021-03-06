<?php

namespace Encore\Reporter;

use Encore\Reporter\Http\Middleware\PjaxMiddleware;
use Illuminate\Support\ServiceProvider;

class ReporterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'reporter');

        $this->publishes([
            __DIR__.'/../config/reporter.php' => config_path('reporter.php'),
            __DIR__.'/../assets' => public_path('vendor/laravel-reporter'),
        ], 'laravel-reporter');

        if (file_exists($routes = __DIR__.'/Http/routes.php')) {
            require $routes;
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('reporter', function ($app) {
            return new Reporter($app);
        });

        app('router')->middleware('pjax', PjaxMiddleware::class);
    }
}
