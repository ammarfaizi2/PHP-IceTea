<?php

/**
 * IceTea Framework Configuration.
 */
ini_set("display_errors", true);
define("BASEPATH", __DIR__);


$env = "development";

/**
 * Database.
 */
$db = [
	"driver" 	=> "mysql",
	"host"   	=> "localhost",
	"port"	 	=> 3306,
	"dbname"	=> "tea_messenger",
	"user"		=> "root",
	"pass"		=> ""
];

/**
 * URL
 */
$url = [
	"base_url" => "http://"._i($_SERVER['HTTP_HOST'])."/index.php",
	"js_url"   => "http://"._i($_SERVER['HTTP_HOST'])."/assets/js",
	"css_url"  => "http://"._i($_SERVER['HTTP_HOST'])."/assets/css",
	"img_url"  => "http://"._i($_SERVER['HTTP_HOST'])."/assets/img",
];

$router_file = "index.php"; // index.php