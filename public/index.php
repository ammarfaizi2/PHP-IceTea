<?php

define("MYICETEA_START", microtime(true));

require __DIR__."/../vendor/autoload.php";
$app = require __DIR__."/../init/web.php";

$app->capture(
	[
		"request" => EsTeh\Foundation\Http\Request::capture(),
		"route"	 => EsTeh\Foundation\Http\Route::capture(),
	]
);

$app->sendResponse();

$app->terminate();

