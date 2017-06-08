<?php

namespace System\Crayner\Set;

use System\Crayner\Cookie\Cookie;

class Set
{
	public function __construct()
	{
	}

	public function header(string $name, string $value)
	{
		return header("{$name}: {$value}");
	}

	public function cookie(string $name, string $value, int $minute = null, string $path = "/",string $domain = null, bool $secure = false, bool $httpOnly = true)
	{
		return Cookie::getInstance()->make($name, $value, $minute, $path, $domain, $secure, $httpOnly);
	}
}