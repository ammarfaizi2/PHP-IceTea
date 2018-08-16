<?php

if (!defined("ICETEA_INIT")) {
	define("ICETEA_INIT", 1);

	require __DIR__."/../config/init.php";

	if (!defined("BASEPATH")) {
		print "BASEPATH is not defined!\n";
		exit(1);
	}

	if (!defined("SRC_PATH")) {
		print "SRC_PATH is not defined!\n";
		exit(1);
	}

	/**
	 * @param string $class
	 * @return void
	 */
	function iceteaInternalClassAutoloader(string $class): void
	{
		$class = str_replace("\\", "/", $class);
		if (file_exists($f = SRC_PATH."/classes/".$class.".php")) {
			require $f;
			return;
		} else {
			if (substr($class, 0, 3) === "Phx") {
				if (file_exists($f = SRC_PATH."/phx/classes/".$class.".phx")) {
					require $f;
					return;
				}
			}
		}
	}

	spl_autoload_register("iceteaInternalClassAutoloader");

	require SRC_PATH."/helpers.php";

	if (defined("LOAD_DOT_ENV") && (!is_null(LOAD_DOT_ENV))) {
		$f = new \IceTea\DotEnv\Loader(LOAD_DOT_ENV);
		$f->load();
	}	

	if (file_exists($f = BASEPATH."/vendor/autoload.php")) {
		require $f;
	}
}
