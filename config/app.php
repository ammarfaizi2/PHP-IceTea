<?php

return [
    'name' => env('APP_NAME', 'MyIceTea'),
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => env('APP_KEY'),

    'providers' => [
        App\Providers\RouteServiceProvider::class
    ],

    'aliases' => [
    	'Route' => EsTeh\Routing\Route::class,
        'DB' => EsTeh\Database\DB::class,

        /**
         * Singleton trait.
         */
        'Singleton' => EsTeh\Hub\Singleton::class
    ]
];
