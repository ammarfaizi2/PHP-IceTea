<?php

namespace IceTea\Config;

use IceTea\Hub\Singleton;

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
		Singleton::set("config", $this);
	}

	/**
	 * @param $key
	 * @return mixed
	 */
	public function privateGet($key)
	{
		$key = explode(".", $key);

		if (! array_key_exists($file = $key[0], $this->config)) {
			$this->config[$key[0]] = requireFile($this->configPath."/".$file.".php");
		}

		if (count($key) === 1) {
			return $this->config[$key[0]];
		}

		$tmp = $this->config[$key[0]];
		unset($key[0]);

		foreach ($key as $key) {
			$tmp = $tmp[$key];
		}

		return $tmp;
	}

	public static function get($key)
	{
		return Singleton::get("config")->privateGet($key);
	}
}
