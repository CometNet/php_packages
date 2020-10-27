<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin name
    |--------------------------------------------------------------------------
    |
    | This value is the name of admin, This setting is displayed on the
    | login page.
    |
    */
    'name' => '用户中心',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin install directory
    |--------------------------------------------------------------------------
    |
    | The installation directory of the controller and routing configuration
    | files of the administration page. The default is `app/Admin`, which must
    | be set before running `artisan admin::install` to take effect.
    |
    */
    'directory' => app_path('UCenter'),

    /*
    |--------------------------------------------------------------------------
    | Admin route settings
    |--------------------------------------------------------------------------
    |
    | The routing configuration of the admin page, including the path prefix,
    | the controller namespace, and the default middleware. If you want to
    | access through the root path, just set the prefix to empty string.
    |
    */
    'route' => [

        'prefix' => env('UCENTER_ROUTE_PREFIX', 'ucenter'),

        'namespace' => 'App\\UCenter\\Controllers',

        'middleware' => ['web', 'ucenter'],
    ],
    /*
    |--------------------------------------------------------------------------
    | Admin auth setting
    |--------------------------------------------------------------------------
    |
    | Authentication settings for all admin pages. Include an authentication
    | guard and a user provider setting of authentication driver.
    |
    | You can specify a controller for `login` `logout` and other auth routes.
    |
    */
    'auth' => [

        'controller' => App\UCenter\Controllers\AuthController::class,

        'guard' => 'ucenter',

        'guards' => [
            'ucenter' => [
                'driver'   => 'session',
                'provider' => 'ucenter',
            ],
        ],

        'providers' => [
            'ucenter' => [
                'driver' => 'eloquent',
                'model'  => Huixing\UCenter\Models\User::class,
            ],
        ],

        // Add "remember me" to login form
        'remember' => true,

        // Redirect to the specified URI when user is not authorized.
        'redirect_to' => 'auth/login',

        // The URIs that should be excluded from authorization.
        'excepts' => [
            'auth/login',
            'auth/logout',
            'auth/register',
            '_handle_action_',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin database settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for laravel-admin builtin model & tables.
    |
    */
    'database' => [

        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'users',
        'users_model' => Huixing\UCenter\Models\User::class,
    ],

    'menus' => [
        [
            'title' => '控制台',
            'uri' => '/',
            'icon' => 'fa-tachometer-alt',
        ],
        [
            'title' => '账号管理',
            'uri' => 'account',
            'icon' => 'fa-user',
            'children' => [
                [
                    'title' => '基本信息',
                    'uri' => 'account/index',
                    'icon' => 'fa-user',
                ]
            ]
        ],
        [
            'title' => '费用管理',
            'uri' => '',
            'icon' => 'fa-money-check-alt',
            'children' => [
                [
                    'title' => '费用总览',
                    'uri' => 'cost/index',
                    'icon' => 'fa-chart-pie',
                ],
                [
                    'title' => '账户充值',
                    'uri' => 'cost/invest',
                    'icon' => 'fa-credit-card',
                ],
                [
                    'title' => '充值明细',
                    'uri' => 'cost/detailed',
                    'icon' => 'fa-coins',
                ],
                [
                    'title' => '消费明细',
                    'uri' => 'cost/consumer',
                    'icon' => 'fa-chart-line',
                ],
                [
                    'title' => '优惠券管理',
                    'uri' => 'cost/coupon',
                    'icon' => 'fa-tags',
                ]
            ]
        ],
//        [
//            'title' => '任务列表',
//            'uri' => '/',
//            'icon' => 'fa-user',
//            'children' => [
//                [
//                    'title' => '任务列表',
//                    'uri' => '/',
//                    'icon' => 'fa-user',
//                ]
//            ]
//        ]
    ]
];
