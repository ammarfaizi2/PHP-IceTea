<?php

$app = new \IceTea\Foundation\Application(
	\IceTea\Foundation\ApplicationType::WEB_APPLICATION, 
	[
		"route" => \App\Providers\RouteServiceProvider::class
	],
	realpath(__DIR__ . "/..")
);

$app->run();
