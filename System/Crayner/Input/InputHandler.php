<?php

namespace System\Crayner\Input;

use System\Crayner\Contracts\Input\PostGate;
use System\Crayner\Contracts\Input\InputBinding;
use System\Crayner\WhiteHat\Encryption\Teacrypt\Teacrypt;

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

	/**
	 * @return InputHandler
	 */
	public function phpInput()
	{
		$this->toString = $this->phpInput;
		return $this;
	}

	/**
	 * @param  string	$key
	 * @return InputHandler
	 */
	public function post(string $key)
	{
		$this->toString = isset($this->purePost[$key]) ? $this->purePost[$key] : "";
		return $this;
	}

	/**
	 * @param	int	$cat
	 * @return  InputHandler
	 */
	public function escape(int $cat = 0)
	{
		if ($cat === 5) {
			$this->toString = addcslashes($this->toString, "A..z");
		} else {
			$this->toString = addslashes($this->toString);
		}
		return $this;
	}

	/**
	 * @param  string	$key
	 * @return InputHandler
	 */
	public function encrypt($key)
	{
		$this->toString = Teacrypt::encrypt($this->toString, $key);
		return $this;
	}

	public function __toString()
	{
		return $this->toString;
	}
}