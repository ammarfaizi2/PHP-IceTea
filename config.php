<?php

/**
 * IceTea Framework.
 */


/**
 * Database.
 */
define("DBHOST", "localhost");
define("DBUSER", "debian-sys-maint");
define("DBPASS", "");
define("DBNAME", "iceeta");

/**
 * Base URL.
 */
$baseurl = "http".(isset($_SERVER['HTTPS']) ? "s" : "")."://".$_SERVER['HTTP_HOST']);
define("BASEURL", $baseurl);
