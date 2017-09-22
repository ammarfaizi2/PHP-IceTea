<?php

/**
 * Load config file.
 */
defined("BASEPATH") or require __DIR__."/../config.php";

if (! file_exists(BASEPATH."/vendor/autoload.php")) {
	/**
	 * Load helpers.
	 */
	require __DIR__."/sys.vendor/helpers/rstr.php";
	require __DIR__."/sys.vendor/helpers/system.php";
	require __DIR__."/sys.vendor/helpers/encryption.php";
	/**
	 * Class loader.
	 */
	function ___load_class($class)
	{
	    $a = explode("\\", $class, 2);
	    if ($a[0] == "App") {
	        require __DIR__."/app/".str_replace("\\", "/", $a[1]).".php";
	    } else {
	        require __DIR__."/src/".str_replace("\\", "/", $class).".php";
	    }
	}
	spl_autoload_register("___load_class");
}

/**
 * Load routes.
 */
require BASEPATH."/app/Routes/web.php";
System\Router::apiFlag();
require BASEPATH."/app/Routes/api.php";
