<?php
/**
 * IceTea Framework Autoload.
 */




/**
 * Load config file.
 */
require __DIR__."/config.php";

/**
 * Class loader.
 */
function ___load_class($class)
{
	$map = [
		"Models" => "app",
		"Controllers" => "app"
	];
	$a = explode("\\", $class, 2);
	if (count($a)>1 && isset($map[$a[0]])) {
		require __DIR__."/".$map[$a[0]]."/".str_replace("\\", "/", $class).".php";
	} else {
		require __DIR__."/src/".str_replace("\\", "/", $class).".php";
	}
}

spl_autoload_register("___load_class");