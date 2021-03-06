<?php

namespace TiBian\BrowserRequirement;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class BrowserRequirementServiceProvider
 *
 * @package TiBian\BrowserRequirement
 */
class BrowserRequirementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $this->publishes([
            __DIR__.'/../config/browser.php' => config_path('browser.php'),
        ], 'config');

        $router->prependMiddlewareToGroup('web', BrowserRequirement::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/browser.php', 'browser');
    }
}
