<?php

function env($key, $def = null)
{
	return \IceTea\Utils\EnvirontmentVariables::get($key, $def);
}


function view($file, $variable = [])
{
	return \IceTea\View\View::buildView($file, $variable);
}


function ___viewIsolator($____file, $____variable = [])
{
	foreach ($____variable as $____key => $____value) {
		$$____key = $____value;
	}
	return include $____file;
}

function basepath($file = "")
{
	return rtrim(realpath(__DIR__."/../../")."/".$file, "/");
}