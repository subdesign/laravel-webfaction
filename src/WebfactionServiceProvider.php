<?php

namespace Subdesign\LaravelWebfaction;

use Illuminate\Support\ServiceProvider;

class WebfactionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/webfaction.php' => config_path('webfaction.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/webfaction.php', 'webfaction');

        $this->app->singleton('webfaction', function ($app) {            
            return new Webfaction($app->config->get('webfaction', []));
        });

        $this->app->alias('webfaction', Webfaction::class);
    }
}
