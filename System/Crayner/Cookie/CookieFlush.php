<?php

namespace System\Crayner\Cookie;

use Closure;

class CookieFlush
{
	/**
	 *
	 * @var Closure
	 */
	private $func;

	/**
	 *
	 * Constructor.
	 *
	 * @param Closure	$func
	 *
	 */
	public function __construct(Closure $func = null)
	{
		$this->func = $func;
	}

	public function __toString()
	{
		if ($this->func instanceof Closure) {
			$b = $this->func;
			return $b();
		} else {
			return "";
		}
	}

	public function __destruct()
	{
		if ($this->func instanceof Closure) {
			$b = $this->func;
			$b();
		}
	}
}