<?php

namespace IceTea\Config;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Config
 */
final class Config
{
	/**
	 * @var array
	 */
	private $config = [];

	/**
	 * @var string
	 */
	private $configPath;

	/**
	 * Constructor.
	 *
	 * @param string $configPath
	 * @return void
	 */
	public function __construct($configPath)
	{
		$this->configPath = $configPath;
	}

	/**
	 * @param $key
	 */
	public function get($key)
	{

	}
}
