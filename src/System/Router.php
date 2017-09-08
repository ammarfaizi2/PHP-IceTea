<?php

namespace System;

use System\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Router
{
	use Singleton;

	/**
	 * @var array
	 */
	private $uri = [];

	/**
	 * @var array
	 */
	private $routes = [];

	public function __construct()
	{
	}

	/**
	 * Load all routes.
	 */
	public static function loadRoutes()
	{
		return self::getInstance()->routes;
	}

	/**
	 * @param string			$route
	 * @param string|Closure	$action
	 * @param string 			$method
	 */
	public static function addRoute($route, $action, $method)
	{
		self::getInstance()->__addRoute($route, $action, $method);
	}

	/**
	 * @param string			$route
	 * @param string|Closure	$action
	 * @param string 			$method
	 */
	private function __addRoute($route, $action, $method)
	{
		$this->routes[$route][$method] = $action;
	}

	/**
	 * Get uri segments.
	 */
	private function getUri()
	{
		$this->uri = explode("/", $_SERVER['REQUEST_URI']);
	}
}