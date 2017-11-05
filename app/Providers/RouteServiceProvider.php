<?php

namespace App\Providers;

use IceTea\Foundation\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	public function boot()
	{
		parent::boot();
	}

	public function map()
	{
		$this->mapWebRoutes();
		// $this->mapApiRoutes();
	}

	private function mapWebRoutes()
	{
		require basepath("routes/web.php");
	}
}