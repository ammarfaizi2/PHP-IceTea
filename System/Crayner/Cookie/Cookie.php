<?php

namespace System\Crayner\Cookie;

use System\Crayner\Hub\Singleton;
use System\Crayner\Input\InputUtilities;
use System\Crayner\Contracts\Cookie\CookieTable;

/**
 * @author Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Cookie implements CookieTable
{
	/**
	 * Use Singleton trait.
	 */
	use Singleton;

	/**
	 * @var string
	 */
	private $toString;

	/**
	 *
	 * Constructor.
	 *
	 *
	 *
	 */
	public function __construct()
	{

	}

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
	public function make(string $name, string $value, int $minute = null, string $path = "/",string $domain = null, bool $secure = false, bool $httpOnly = true)
	{
		$this->toString = $value;
		$this->func		= function($value) use ($name, $minute, $path, $domain, $secure, $httpOnly){
			setcookie($name, $value, time()+($minute * 60), $path, $domain, $secure, $httpOnly);
		};
		return new InputUtilities($this->toString, $this->func);
	}

	/**
	 * Get cookie value.
	 *
	 * @param 	string	$name
	 * @return 	string
	 */
	public function get(string $name)
	{
		$this->toString = isset($_COOKIE[$name]) ? $_COOKIE[$name] : "";
		return new InputUtilities($this->toString);
	}

	/**
	 * Delete cookie.
	 *
	 * @param	string	$name
	 * @return	bool
	 */
	public function delete(string $name)
	{
		$this->func = function() use($name){
			setcookie($name, null, 0);
			return $name;
		};
		return new CookieFlush($this->func);
	}


	public function __toString()
	{
		if (isset($this->func)) {
			$b = $this->func;
			$b($this->toString);
		}
		return $this->toString;
	}

	
}