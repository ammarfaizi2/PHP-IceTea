<?php

namespace System\Crayner\Contracts\Cookie;

interface CookieTable
{
	/**
     * Create a new cookie.
     *
     * @param  string  $name
     * @param  string  $value
     * @param  int     $minutes
     * @param  string  $path
     * @param  string  $domain
     * @param  bool    $encrypt
     * @param  bool    $httpOnly
     * @return bool
     */
	public function make(string $name, string $value, int $minute = null, string $path = "/",string $domain = null, bool $secure = false, bool $httpOnly = true);

	/**
	 * Get cookie value.
	 *
	 * @param 	string	$name
	 * @return 	string
	 */
	public function get(string $name);

	/**
	 * Delete cookie.
	 *
	 * @param string	$name
	 * @return bool
	 */
	public function delete(string $name);

}