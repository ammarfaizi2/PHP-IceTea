<?php

namespace IceTea\Routing;

use Iterator;
use IceTea\Dispatcher\MasterDispatcher;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Routing
 */
final class RoutesContainer implements Iterator
{
	/**
	 * @var array
	 */
	private $container = [];

	/**
	 * @var int
	 */
	private $groupPointer = 0;

	/**
	 * @var int
	 */
	private $iteratorPosition = 0;

	/**
	 * @var string
	 */
	private $prefix = ["/"];

	/**
	 * @var array
	 */
	private $middlewares = [];

	/**
	 * @var string
	 */
	private $methodToFetch;

	/**
	 * @param string $method
	 * @param string $path
	 * @param string $action
	 * @return \IceTea\Routing\RouteMember
	 */
	public function &set($method, $path, $action)
	{
		$path = implode($this->prefix, "/")."/".$path;

		do {
			$path = str_replace("//", "/", $path, $n);
		} while ($n);

		$middlewares = [];

		foreach ($this->middlewares as $middleware) {
			if (is_array($middleware)) {
				$middlewares = array_merge($middlewares, $middleware);
			} else {
				$middlewares[] = $middleware;
			}
		}

		$this->container[$path][$method] = new RouteMember([
			"action" => $action,
			"middlewares" => array_unique($middlewares),
			"path" => $path,
			"method" => $method
		]);

		return $this->container[$path][$method];
	}

	/**
	 * @return mixed
	 */
	public function current()
	{
		return $this->container[];
	}

	/**
	 * @param string $method
	 */
	public function fetch($method)
	{
		$this->methodToFetch = $method;
	}


	/**
	 * @param array $option
	 * @param mixed $action
	 * @return void
	 */
	public function routeGroupOpen($option, $action)
	{
		$this->groupPointer++;
		isset($option["prefix"]) and $this->prefix[$this->groupPointer] = $option["prefix"];

		if (isset($option["middleware"])) {
			if (is_array($option["middleware"])) {
				$this->middlewares[$this->groupPointer] = $option["middleware"];
			} else {
				$this->middlewares[$this->groupPointer] = $option["middleware"];
			}
		}

		$dispatcher = new MasterDispatcher($action);
		$dispatcher->dispatch();

		$this->routeGroupClose();
	}


	/**
	 * @return void
	 */
	public function routeGroupClose()
	{
		unset($this->prefix[$this->groupPointer], $this->middlewares[$this->groupPointer]);
		$this->groupPointer--;
	}
}
