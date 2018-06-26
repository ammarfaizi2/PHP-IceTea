<?php

if (! defined("ICETEA_START")) {
	define("ICETEA_START", microtime(true));
	define("ICETEA_PATH", realpath(__DIR__."/.."));

	ini_set("display_errors", true);


	// Use composer autoloader if exists.
	if (file_exists($f = ICETEA_PATH."/vendor/autoload.php")) {
		require $f;
	} else {

		function iceTeaInternalAutoloader($class)
		{
			$class = str_replace("\\", "/", $class);
			if (file_exists($f = ICETEA_PATH."/core/classes/".$class.".php")) {
				require $f;
			}
		}

		spl_autoload_register("iceTeaInternalAutoloader");
	}

	require ICETEA_PATH."/core/helpers.php";

	$singleton = \IceTea\Hub\Singleton::init(
		[
			"db" => [\IceTea\Database\DB::class]
		]
	);
	$config = new \IceTea\Config\Config(ICETEA_PATH."/config");

	$aliasLoader = new \IceTea\Foundation\AliasLoader($config->get(
		"app.class_aliases"
	));
	$aliasLoader->load();

	return $singleton;
}
