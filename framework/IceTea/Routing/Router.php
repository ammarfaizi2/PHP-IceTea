<?php

namespace IceTea\Routing;

use Closure;
use IceTea\Hub\Singleton;
use IceTea\Exceptions\Http\MethodNotAllowedException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Router
{
	use Singleton;

	private $uri;

	private $isEndPointWithFile = false;

	public function __construct()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	public function fire()
	{
		$func = $this->urlGenerator();
		foreach(RouteCollector::getInstance()->getRoutes() as $route => $val) {
			if ($this->{$func}($route)) {	
				$reqMethod = $_SERVER['REQUEST_METHOD'];
				if (
					isset($val[$reqMethod]) or
					(isset($val[true]) and $reqMethod = true)
				) {
					if (
						$val[$reqMethod] instanceof Closure
					) {
						return $val[$reqMethod]();
					} else {
						
					}
				} else {
					throw new MethodNotAllowedException("Method not allowed", 1);
				}
			}
		}
		return false;
	}

	private function urlGenerator()
	{
		$this->uri = explode("?", $this->uri);
		if (($c = count($this->uri)) > 1) unset($this->uri[$c - 1]);
		$this->uri = implode("/", $this->uri);
		do {
			$this->uri = str_replace("//", "/", $this->uri, $n);
		} while ($n);
		$this->uri = "/".trim($this->uri, "/");
		$endpointFile = $_SERVER["SCRIPT_NAME"];
		$endpointFile = explode("/", $endpointFile);
		$file = $endpointFile[$c = count($endpointFile) - 1];
		unset($endpointFile[$c]);
		$endpointFile = implode("/", $endpointFile);
		var_dump($this->uri);
	}
}
