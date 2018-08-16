<?php

return [
	"use_driver" => "mysql",
	"drivers" => [
		"mysql" => [
			"host" => env("DB_HOST", "127.0.0.1"),
			"port" => env("DB_PORT", "3306"),
			"username" => env("DB_USER", "root"),
			"password" => env("DB_PASS", ""),
			"database" => env("DB_NAME", "icetea")
		]
	]
];
