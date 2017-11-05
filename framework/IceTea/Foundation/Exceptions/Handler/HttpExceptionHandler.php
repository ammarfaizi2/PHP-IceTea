<?php

namespace IceTea\Foundation\Exceptions\Handler;

class HttpExceptionHandler
{
	public function __construct($e)
	{
		$this->e = $e;
	}

	public function handle()
	{
		return $this->e;
	}
}