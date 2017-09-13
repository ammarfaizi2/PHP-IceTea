<?php
define("BASEPATH", __DIR__);

/**
 * Load config file.
 */
require __DIR__."/config.php";

/**
 * Load helpers.
 */
require __DIR__."/src/Helpers/rstr.php";
require __DIR__."/src/Helpers/system.php";
require __DIR__."/src/Helpers/encryption.php";

/**
 * Class loader.
 */
function ___load_class($class)
{
    $a = explode("\\", $class, 2);
    if ($a[0] === "App") {
        require __DIR__."/app/".str_replace("\\", "/", $a[1]).".php";
    } else {
        require __DIR__."/src/".str_replace("\\", "/", $class).".php";
    }
}

spl_autoload_register("___load_class");

/**
 * Load routes.
 */
require __DIR__."/app/Routes/web.php";
System\Router::apiFlag();
require __DIR__."/app/Routes/api.php";
