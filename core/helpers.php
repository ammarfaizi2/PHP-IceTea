<?php

if (!function_exists("rstr")) {
	/**
	 * @author Ammar Faizi <ammarfaizi2@gmail.com>
	 * @param int     $n
	 * @param string  $e
	 * @return string
	 */
	function rstr(int $n = 32, string $e = null): string
	{
		$n = abs($n);
		if (is_null($e)) {
			$e = "1234567890qwertyuiopasdfghjklzxcvbnnmQWERTYUIOOPASDFGHJKLZXCVBNM_____-----.....";
		}
		$c = strlen($e) - 1;
		$r = "";
		for ($i=0; $i < $n; $i++) { 
			$r .= $e[rand(0, $c)];
		}
		return $r;
	}
}

if (!function_exists("env")) {
	/**
	 * @param string $key
	 * @param mixed  $default
	 * @return mixed
	 */
	function env(string $key, $default = null)
	{
		if (($v = getenv($key)) !== false) {
			if (substr($v, 0, 1) === "\"" && substr($v, -1, 1) === "\"") {
				$v = substr($v, 1, -1);
			}
			return $v;
		}

		return $default;
	}
}
