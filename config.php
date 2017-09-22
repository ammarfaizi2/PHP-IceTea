<?php

ini_set("display_errors", true);
define("BASEPATH", __DIR__);

/**
 * IceTea Framework.
 */


/**
 * Database.
 */
define("DBHOST", "localhost");
define("DBUSER", "debian-sys-maint");
define("DBPASS", "");
define("DBNAME", "icetea");
define("DBPORT", "3306");

/**
 * Base URL.
 */
$baseurl = "http".(isset($_SERVER['HTTPS']) ? "s" : "")."://".(@$_SERVER['HTTP_HOST']);

define("BASEURL", $baseurl);
define("ROUTER_FILE", false);
