<?php

if (! function_exists("rstr")) {
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

if (! function_exists("requireFile")) {
	/**
	 * @param string $file
	 * @return mixed
	 */
	function requireFile($file)
	{
		return require $file;
	}
}

if (! function_exists("singleton")) {
	/**
	 * @param $key string
	 * @return object
	 */
	function singleton($key = null)
	{
		$ins = \IceTea\Hub\Singleton::getSelfInstance();
		if (is_string($key)) {
			return $ins->get($key);
		}
		return $ins;
	}
}

if (! function_exists("config")) {
	/**
	 * @param string $key
	 * @return mixed
	 */
	function config($key = null)
	{
		$ins = singleton("config");
		if (is_string($key)) {
			return $ins->get($key);
		}
		return $ins;
	}
}
