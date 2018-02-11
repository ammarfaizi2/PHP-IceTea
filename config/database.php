<?php
return [
    "connection" => env("DB_CONNECTION", "mysql"),
    "mysql" => [
        "driver"    => "mysql",
        "host"      => env("DB_HOST", "localhost"),
        "port"      => env("DB_PORT", "3306"),
        "user"      => env("DB_USERNAME", "root"),
        "pass"      => env("DB_PASS", ""),
        "dbname"    => env("DB_DATABASE", "test")
    ]
];
