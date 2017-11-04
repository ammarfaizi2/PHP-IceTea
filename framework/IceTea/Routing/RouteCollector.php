<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;

class RouteCollector
{
	use Singleton;

	/**
	 * Routes
	 *
	 * @var array
	 */
	private $routes = [];


	public function __construct()
	{
	}

	public static function collect($route, $action, $method)
	{
		$ins = self::getInstance();
		$ins->routes[$route][$method] = $action;
	}

	public static function loadRoutes()
	{
		includer(basepath("routes/web.php"));
	}

	public static function getRoutes()
	{
		return self::getInstance()->routes;
	}
}

/**
 * Scope isolated.
 * Prevent access $this or self from included file.
 */
function includer($file)
{
	require $file;
}