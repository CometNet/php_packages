<?php
namespace Huixing\UCenter;

use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\Renderable;

class UCenterServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        Console\InstallCommand::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'ucenter.auth'       => Middleware\Authenticate::class,
        'ucenter.pjax'       => Middleware\Pjax::class
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'ucenter' => [
            'ucenter.auth',
            'ucenter.pjax'
        ],
    ];


    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ucenter');

        if (file_exists($routes = ucneter_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        $this->registerPublishing();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadAdminAuthConfig();

        $this->registerRouteMiddleware();

        $this->commands($this->commands);

        $this->macroRouter();
    }

    /**
     * Extends laravel router.
     */
    protected function macroRouter()
    {

        Router::macro('content', function ($uri, $content, $options = []) {
            return $this->match(['GET', 'HEAD'], $uri, function (Content $layout) use ($content, $options) {
                return $layout
                    ->title(Arr::get($options, 'title', ' '))
                    ->description(Arr::get($options, 'desc', ' '))
                    ->body($content);
            });
        });

        Router::macro('component', function ($uri, $component, $data = [], $options = []) {
            return $this->match(['GET', 'HEAD'], $uri, function (Content $layout) use ($component, $data, $options) {
                return $layout
                    ->title(Arr::get($options, 'title', ' '))
                    ->description(Arr::get($options, 'desc', ' '))
                    ->component($component, $data);
            });
        });
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'ucenter-config');
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'ucenter-lang');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'ucenter-migrations');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/ucenter')], 'ucenter-assets');
        }
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(config('ucenter.auth', []), 'auth.'));
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
