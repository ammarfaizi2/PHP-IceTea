<?php

function basepath($file = "")
{
	return rtrim(realpath(__DIR__."/../../")."/".$file, "/");
}