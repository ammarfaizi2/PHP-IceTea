<?php

namespace System\Exception;

use Exception;

class MethodNotAllowedHttpException extends Exception
{
	public function __construct($msg, $code = 1)
	{
		http_response_code(500);
		parent::__construct($msg, $code);
	}

	public function __toString()
	{
		return "[".__CLASS__."] : ".$this->getMessage();
	}
}