<?php

function __icetea_start()
{
	require BASEPATH."/app/Routes/web.php";
	System\Router::apiFlag();
	require BASEPATH."/app/Routes/api.php";
}