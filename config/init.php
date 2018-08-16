<?php

define("BASEPATH",	realpath(__DIR__."/.."), true);

define("SRC_PATH", BASEPATH."/core");

/**
 * Set null in production.
 */
define("LOAD_DOT_ENV", BASEPATH."/.env");
