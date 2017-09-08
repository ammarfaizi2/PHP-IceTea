<?php

namespace System;

use Closure;
use System\Hub\Singleton;
use System\Exceptions\MethodNotAllowedException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Router
{
	use Singleton;

	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var array
	 */
	private $routes = [];

	public function __construct()
	{
	}

	/**
	 * @param string 		 $key
	 * @param string|Closure $action
	 * @return bool
	 */
	public static function action($key, $action)
	{
		$ins = self::getInstance();
		if ($key === $ins->uri) {
			if (isset($action[$_SERVER['REQUEST_METHOD']])) {
				return self::__run($action[$_SERVER['REQUEST_METHOD']]);	
			} else {
				http_response_code(402);
				throw new MethodNotAllowedException("Error Processing Request", 1);
				return true;
			}
		}
		return false;
	}

	/**
	 * @param string|Closure $action
	 * @param array			 $param
	 * @return bool
	 */
	private static function __run($action, $param = null)
	{
		if ($action instanceof Closure) {
			return $action();
		} else {
			$a = explode("@", $param);
			$app = "\\Controllers\\".$a[0];
			$app = new $app(...$param);
			$app->{$a[1]}();
		}
		return true;
	}

	/**
	 * Load all routes.
	 */
	public static function loadRoutes()
	{
		$ins = self::getInstance();
		$ins->getUri();
		return $ins->routes;
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
		$a = $_SERVER['REQUEST_URI'];
		do {
			$a = str_replace("//", "/", $a, $n);
		} while ($n);
		$this->uri = "/".trim($a, "/");
	}
}