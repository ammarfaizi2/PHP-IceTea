<?php

namespace IceTea\Foundation\Exceptions;

use Exception;

class Handler
{
	protected $exception;

	final public function __construct(Exception $e)
	{
		$this->exception = $e;
	}

	final public function reconstruct(Exception $e)
	{
	}

	final public function handle()
	{
		return $this->report($this->exception);
	}

	public function report(Exception $e)
	{
		return $e;
	}

	protected function shouldntReport(Exception $e)
	{
		return in_array(get_class($e), $this->dontReport);
	}
}