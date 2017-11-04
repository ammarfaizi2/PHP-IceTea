<?php

namespace IceTea\Exceptions;

class ExceptionInfo
{
	public static $http = [
		\IceTea\Exceptions\Http\NotFoundException::class => 404,
		\IceTea\Exceptions\Http\MethodNotAllowedException::class => 405
	];
}