<?php

namespace System\Crayner\Input;

use System\Crayner\Contracts\Input\PostGate;
use System\Crayner\Contracts\Input\InputBinding;

/**
 * @author Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class InputHandler implements InputBinding, PostGate
{
	/**
	 * @var array
	 */
	private $purePost;

	/**
	 * @var string
	 */
	private $phpInput;

	/**
	 * @var string
	 */
	private $toString;

	/**
	 *
	 * Constructor.
	 *
	 *
	 */
	public function __construct()
	{
		$this->purePost = is_array($_POST) ? $_POST : array();
		$this->phpInput = file_get_contents("php://input");
	}

	public function phpInput()
	{
		$this->toString = $this->phpInput;
		return $this;
	}

	public function post(string $key)
	{
		$this->toString = isset($this->purePost[$key]) ? $this->purePost[$key] : "";
		return $this;
	}

	public function escape(int $cat = 0)
	{
		$this->toString = addslashes($this->toString);
		return $this;
	}

	public function __toString()
	{
		return $this->toString;
	}
}