<?php

namespace IceTea\Routing;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Routing
 */
final class RouteMember
{
	/**
	 * @var mixed
	 */
	public $action;

	/**
	 * @param array $state
	 */
	public function __construct($state)
	{
		$this->action = $state["action"];
		$this->middlewares = $state["middlewares"];
		$this->method = $state["method"];
		$this->path = $state["path"];
	}

	/**
	 * 
	 */
	public function name()
	{
	}
}
