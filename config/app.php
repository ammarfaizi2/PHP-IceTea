<?php

return [
	"base_url" => "http://127.0.0.1",
	"asset_url" => "http://127.0.0.1/assets",

	"route_dir" => ICETEA_PATH."/routes",

	"key" => "key123",
	"class_aliases" => [
		"DB" => \IceTea\Database\DB::class,
		"Route" => \IceTea\Routing\RoutesHandler::class,
		"Singleton" => \IceTea\Hub\Singleton::class
	]
];
