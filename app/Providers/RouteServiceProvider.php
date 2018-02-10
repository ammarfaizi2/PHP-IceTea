<?php

namespace App\Providers;

use EsTeh\Routing\Router;
use EsTeh\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

	/**
	 * @var string
	 */
	protected $namespace = "App\\Http\\Controllers";

	public function boot()
	{
		$this->mapWebRoutes();
	}

	/**
	 * Load web routes.
	 */
	private function mapWebRoutes()
	{
		Router::loadWebRoutes(base_path("routes/web.php"));
	}
}
