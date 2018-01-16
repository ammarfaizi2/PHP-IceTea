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





    'aliases' => [
    	'Route' => EsTeh\Routing\Route::class
    ]
];
