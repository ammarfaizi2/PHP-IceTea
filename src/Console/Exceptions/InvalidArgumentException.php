<?php

namespace Console\Exception;

use Exception;

class InvalidArgumentException extends Exception
{
	public function __construct(...$par)
	{
		parent::__construct(...$par);
	}
}