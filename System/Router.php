<?php

namespace System;

use Closure;
use System\Crayner\Hub\Singleton;


/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Router
{
	/**
	 * Use singleton pattern.
	 */
	use Singleton;

	/**
	 * Uri Segments
	 *
	 * @var	array
	 */
	private $segments;

	/**
	 *
	 * Constructor.
	 *
	 * @param array	$segments
	 *
	 */
	public function __construct(array $segments)
	{
		$this->segments = $segments;
	}

	/**
	 *
	 * Set Route.
	 *
	 * @param string			$route
	 * @param string|Closure	$action
	 * @param string			$type
	 */
	private function setRoute(string $route, $action, string $type = "GET")
	{

	}

	/**
	 *
	 *
	 *
	 * @param string			$route
	 * @param string|Closure	$action
	 */
	public static function get(string $route, $action)
	{

	}
}