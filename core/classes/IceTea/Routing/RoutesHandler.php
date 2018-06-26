<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Routing
 */
final class RoutesHandler
{
	/**
	 * @param string $path
	 * @param mixed  $action
	 * @return \IceTea\Routing\RouteMember
	 */
	public static function get($path, $action)
	{
		return self::setRoute("GET", $path, $action);
	}

	/**
	 * @param string $path
	 * @param mixed  $action
	 * @return \IceTea\Routing\RouteMember
	 */
	public static function post($path, $action)
	{
		return self::setRoute("POST", $path, $action);
	}

	/**
	 * @param string $path
	 * @param mixed  $action
	 * @return \IceTea\Routing\RouteMember
	 */
	public static function delete($path, $action)
	{
		return self::setRoute("DELETE", $path, $action);
	}

	/**
	 * @param string $path
	 * @param mixed  $action
	 * @return \IceTea\Routing\RouteMember
	 */
	public static function put($path, $action)
	{
		return self::setRoute("PUT", $path, $action);
	}

	/**
	 * @param string $path
	 * @param mixed  $action
	 * @return \IceTea\Routing\RouteMember
	 */
	public static function patch($path, $action)
	{
		return self::setRoute("PATCH", $path, $action);
	}

	/**
	 * @param array $option
	 * @param mixed $action
	 * @return void
	 */
	public function group($option, $action)
	{
		return Singleton::get("routes_container")
			->routeGroupOpen($option, $action);
	}

	/**
	 * @param string $method
	 * @param string $path
	 * @param string $action
	 * @return \IceTea\Routing\RouteMember
	 */
	private static function setRoute($method, $path, $action)
	{
		return Singleton::get("routes_container")
			->set($method, $path, $action);
	}
}
