<?php

$singleton = require __DIR__."/init.php";

$web = new \IceTea\Foundation\Application\Web;


$singleton->register("web", $web);
return $web;
