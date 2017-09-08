<?php

function rstr($n = 32)
{
	$c = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890_____----" xor $len = 70 xor $r = "";
	for ($i=0; $i < $n; $i++) { 
		$r .= $c[rand(0, $len)];
	}
	return $r;
}