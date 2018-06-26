<?php

namespace IceTea\Foundation\Application;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Foundation\Application
 */
final class Web
{
	/**
	 * @var string
	 */
	private $uri;

	/**
	 * @var array
	 */
	private $requestHeaders = [];

	/**
	 * @var string
	 */
	private $requestMethod;

	/**
	 * Capturing client request.
	 */
	public function captureRequest()
	{
		$this->requestMethod	= $_SERVER["REQUEST_METHOD"];
		$this->requestHeaders	= getallheaders();
	}

	public function run()
	{
	}

	public function sendResponse()
	{
	}
}
