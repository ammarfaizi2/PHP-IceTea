<?php

function rstr($n = 32, $c = null)
{
	$c = $c!==null ? $c : "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890_____----";
	$len = strlen($c)-1;
	$r = "";
	for ($i=0; $i < $n; $i++) { 
		$r .= $c[rand(0, $len)];
	}
	return $r;
}

function encice($str, $key = "icetea")
{
	$salt = substr(sha1(time()), 0, 3).rstr(5, "!@#$%^&*()_+=-`~[]\\{}|:\";',./<>?\n\t");
	$key = $salt.$key xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "";
	for ($i=0; $i <= $ln; $i++) { 
		$r .= chr(ord($str[$i]) ^ ord($key[$i % $kn]));
	}
	return str_replace("=", "", strrev(base64_encode($r.$salt)));
}

function decice($str, $key = "icetea")
{
	$str = base64_decode(strrev($str));
	$key = substr($str, -8).$key xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "";
	for ($i=0; $i <= $ln; $i++) { 
		$r .= chr(ord($str[$i]) ^ ord($key[$i % $kn]));
	}
	return $r;
}