<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;
use IceTea\Config\Config;
use IceTea\Routing\RoutesContainer;
use IceTea\Foundation\Application\Web;
use IceTea\Exceptions\Http\HttpNotFoundException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Routing
 */
final class Router
{
	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var \IceTea\Hub\Singleton
	 */
	private $singleton;

	/**
	 * @var string
	 */
	private $requestMethod;

	/**
	 * @param string $uri
	 * @param string $requestMethod
	 * @return void
	 */
	public function __construct($uri, $requestMethod)
	{
		$this->uri = $uri;
		$this->requestMethod = $requestMethod;
		$dir = Config::get("app.route_dir");
		requireFile($dir."/web.php");
		requireFile($dir."/api.php");
	}

	/**
	 * @throws \IceTea\Exceptions\Http\HttpNotFoundException
	 * @return bool
	 */
	public function run()
	{
		if ($this->matching()) {
			return true;
		}

		throw new HttpNotFoundException;
	}

	/**
	 * @return bool
	 */
	private function matching()
	{
		$st = new RouteMatching(
			Singleton::get("routes_container"),
			Singleton::get("web")
		);
	}

	/**
	 *
	 */
	public function dispatch()
	{
	}

	/**
	 * @return string
	 */
	public static function getUri()
	{
		$filename = explode($_SERVER["DOCUMENT_ROOT"], $_SERVER["SCRIPT_FILENAME"], 2);		
		$self = explode($filename[1], $_SERVER["PHP_SELF"]);
		unset($self[0]);
		return $self[1];
	}
}
