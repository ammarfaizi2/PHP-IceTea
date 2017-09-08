<?php

use System\Router;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class IceTea
{
	public static function run()
	{
		var_dump(Router::loadRoutes());
	}
}