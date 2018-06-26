<?php


/**
 * @param int $n
 * @param string $str
 * @return string
 */
function rstr($n = 32, $str = null)
{
	$str = is_string($str) ? $str : "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM____----....";
	$c = strlen($str) - 1;
	$r = "";
	for ($i=0; $i < $n; $i++) { 
		$r .= $str[rand(0, $c)];
	}
	return $r;
}

if (! function_exists("getallheaders")) {
	/**
	 * @return array
	 */
	function getallheaders() {
		$headers = [];
		foreach ($_SERVER as $name => $value) {
			if (substr($name, 0, 5) == 'HTTP_') {
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
			}
		}
		return $headers;
	}
}
