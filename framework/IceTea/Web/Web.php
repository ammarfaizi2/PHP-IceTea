<?php

namespace IceTea\Web;

use IceTea\View\View;
use IceTea\Routing\Router;
use IceTea\View\ViewFoundation;
use IceTea\Routing\RouteBinding;
use IceTea\Routing\RouteCollector;
use IceTea\Exceptions\Http\NotFoundException;
use IceTea\Foundation\Http\NotFoundFoundation;

final class Web
{
	public function __construct()
	{

	}

	public function routeHandle()
	{
		RouteCollector::loadRoutes();
		$route = new Router();
		$action = $route->fire();
		RouteBinding::destroy();
		if ($action instanceof NotFoundFoundation) {
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