<?php

namespace IceTea\Dispatcher;

use Closure;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Dispatcher
 */
class MasterDispatcher
{
	/**
	 * @var mixed
	 */
	private $action;

	/**
	 * @var array
	 */
	private $parameters = [];

	/**
	 * Constructor.
	 *
	 * @param mixed $action
	 * @param array $parameters
	 * @return void
	 */
	public function __construct($action, $parameters = [])
	{
		$this->action = $action;		
		$this->parameters = $parameters;
	}

	/**
	 * @return mixed
	 */
	public function dispatch()
	{
		if ($this->action instanceof Closure) {
			return call_user_func_array($this->action, $this->parameters);
		}
	}
}
