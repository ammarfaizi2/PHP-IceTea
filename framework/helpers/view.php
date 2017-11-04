<?php

function view($file, $variable = [])
{
	return \IceTea\View\View::buildView($file, $variable);
}


function ___viewIsolator($____file, $____variable = [])
{
	foreach ($____variable as $____key => $____value) {
		$$____key = $____value;
	}
	include $____file;
}