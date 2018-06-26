<?php

namespace IceTea\Foundation\Application;

use IceTea\Hub\Singleton;
use IceTea\Routing\Router;
use IceTea\Routing\RoutesContainer;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Foundation\Application
 */
final class Web
{
	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var \IceTea\Routing\Router
	 */
	private $router;

	/**
	 * @var string
	 */
	private $requestMethod;

	/**
	 * Capturing client request.
	 */
	public function captureRequest()
	{
		$this->requestMethod	= $_SERVER["REQUEST_METHOD"];
		$this->uri				= Router::getUri();
		$this->singleton		= Singleton::set(
			"routes_container", new RoutesContainer
		);
		Singleton::set("web", $this);
	}

	public function run()
	{
		$this->router = new Router($this->requestMethod, $this->uri);
		$this->router->run();
	}

	public function sendResponse()
	{
		$this->router->dispatch();
	}
}
