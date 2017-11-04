<?php

namespace IceTea\Routing;

use Closure;
use IceTea\Hub\Singleton;

class Router
{
	use Singleton;

	public function __construct()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function fire()
	{
		foreach(RouteCollector::getInstance()->getRoutes() as $route => $val) {
			if ($this->isRouteMatch($route)) {				
				if (isset($val[$_SERVER['REQUEST_METHOD']])) {
					if (
						$val[$_SERVER['REQUEST_METHOD']] instanceof Closure
					) {
						return $val[$_SERVER['REQUEST_METHOD']]();
					} else {
						
					}
				} else {
					throw new MethodNotAllowedException("Method not allowed", 1);
				}
			}
		}
		return false;
	}

	private function isRouteMatch($route)
	{
		return $this->uri === $route;
	}
}