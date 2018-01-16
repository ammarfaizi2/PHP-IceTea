<?php

namespace App\Providers;

use IceTea\Routing\Router;
use IceTea\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->mapWebRoutes();
	}

	/**
	 * Load web routes.
	 */
	private function mapWebRoutes()
	{
		Router::loadWebRoutes(base_path('routes/web.php'));
	}
}
