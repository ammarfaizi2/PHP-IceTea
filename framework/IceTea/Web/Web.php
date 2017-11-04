<?php

namespace IceTea\Web;

use IceTea\View\View;
use IceTea\Routing\Router;
use IceTea\View\ViewFoundation;
use IceTea\Routing\RouteCollector;
use IceTea\Exceptions\Http\NotFoundException;

final class Web
{
	public function __construct()
	{

	}

	public function routeHandle()
	{
		RouteCollector::loadRoutes();
		$route = new Router();
		if (! $action = $route->fire()) {
			throw new NotFoundException("Page not found", 1);
		}
		if ($action instanceof ViewFoundation) {
			View::make($action);
		}
	}

	public function terminate()
	{

	}
}