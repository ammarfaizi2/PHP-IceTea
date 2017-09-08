<?php

function view($___view, $___var = null)
{
	if (is_array($___var)) {
		foreach ($___var as $___k => $___v) {
			$$k = $___v;
		}
	}
	require BASEPATH."/app/Views/".$___view.".php";
}