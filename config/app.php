<?php

return [
    "name" => env("APP_NAME", "EsTeh"),
    
    "env" => env("APP_ENV", "production"),
    
    "debug" => env("APP_DEBUG", false),
    
    "url" => env("APP_URL", "http://localhost"),
    
    "timezone" => "UTC",
    
    "locale" => "en",
    
    "fallback_locale" => "en",
    
    "key" => env("APP_KEY"),

    "providers" => [
        App\Providers\RouteServiceProvider::class
    ],

    "aliases" => [
        "App" => EsTeh\Foundation\Application::class,
        "Route" => EsTeh\Routing\Route::class,
        "DB" => EsTeh\Database\DB::class,
        "Config" => EsTeh\Support\Config::class,
        "Request" => EsTeh\Foundation\Http\Request::class,

        /**
         * Singleton trait.
         */
        "Singleton" => EsTeh\Hub\Singleton::class
    ]
];
