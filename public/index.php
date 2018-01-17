<?php

define("MYICETEA_START", microtime(true));

require __DIR__."/../vendor/autoload.php";
$app = require __DIR__."/../init/web.php";

var_dump($app);

$app->capture(
	[
		"header" => EsTeh\Foundation\Http\HeaderRequest::capture()
	]
);

$app->sendResponse();


$app->terminate();
