<?php
namespace Huixing\UCenter;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class App {

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->guard()->user();
    }


    /**
     * Attempt to get the guard from the local cache.
     *
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard()
    {
        $guard = config('ucenter.auth.guard') ?: 'users';

        return Auth::guard($guard);
    }

    /**
     * Register the laravel-admin builtin routes.
     *
     * @return void
     */
    public function routes()
    {
        $attributes = [
            'prefix'     => config('ucenter.route.prefix'),
            'middleware' => config('ucenter.route.middleware'),
        ];

        app('router')->group($attributes, function ($router) {

            /* @var \Illuminate\Support\Facades\Route $router */
            $router->namespace('\Huixing\UCenter\Controllers')->group(function ($router) {
                $router->get('account/index', 'AccountController@index')->name('ucenter.account.index');
                $router->put('account/update', 'AccountController@update')->name('ucenter.account.update');
                $router->resource('cost', 'CostController')->names('ucenter.cost');
            });

            $authController = config('ucenter.auth.controller', AuthController::class);

            /* @var \Illuminate\Routing\Router $router */
            $router->get('auth/login', $authController.'@getLogin')->name('ucenter.login');
            $router->post('auth/login', $authController.'@postLogin');
            $router->get('auth/register', $authController.'@getRegister')->name('ucenter.register');
            $router->post('auth/register', $authController.'@postRegister');
            $router->get('auth/logout', $authController.'@getLogout')->name('ucenter.logout');
            $router->get('auth/setting', $authController.'@getSetting')->name('ucenter.setting');
            $router->put('auth/setting', $authController.'@putSetting');
        });
    }

    /**
     * Left sider-bar menu.
     *
     * @return array
     */
    public function menu()
    {
        return config('ucenter.menus');
    }

    /**
     * @param array $menu
     *
     * @return array
     */
    public function menuLinks($menu = [])
    {
        if (empty($menu)) {
            $menu = $this->menu();
        }

        $links = [];

        foreach ($menu as $item) {
            if (!empty($item['children'])) {
                $links = array_merge($links, $this->menuLinks($item['children']));
            } else {
                $links[] = Arr::only($item, ['title', 'uri', 'icon']);
            }
        }

        return $links;
    }

    public function is_pjax(Request $request){
        return $request->pjax();
    }
}
