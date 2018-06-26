<?php

namespace IceTea\Hub;

use IceTea\Exceptions\SingletonException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 * @since 0.0.1
 * @package \IceTea\Hub
 */
final class Singleton
{
	/**
	 * @var array
	 */
	private $instances = [];

	/**
	 * @var self
	 */
	private static $self;

	/**
	 * Constructor.
	 *
	 * @param array $init
	 * @return void
	 */
	private function __construct($init)
	{
		$this->instances = $init;
	}

	/**
	 * @param array $init
	 */
	public static function init($init)
	{
		self::$self = new self($init);
		return self::$self;
	}

	/**
	 * @param string $key
	 * @throws \IceTea\Exceptions\SingletonException
	 * @return object
	 */
	public static function get($key)
	{
		$ins = self::getSelfInstance();

		if (array_key_exists($key, $ins->instances)) {
			if (is_array($ins->instances[$key])) {
				if (isset($ins->instances[$key][1]) && is_array($ins->instances[$key][1])) {
					$ins->instances[$key] = new $ins->instances[$key][0](
						...$ins->instances[$key] = new $ins->instances[$key][1]
					);
				} else {
					$ins->instances[$key] = new $ins->instances[$key][0];
				}
			}

			if (is_object($ins->instances[$key])) {
				return $ins->instances[$key];
			}

			throw new SingletonException("Could not build object from key ".$key);
		}

		throw new SingletonException("Could not find key ".$key);
	}

	/**
	 * @param string 		$key
	 * @param array|object	$instance
	 * @return bool
	 */
	public static function set($key, $instance)
	{
		$ins = self::getSelfInstance();
		return $ins->register($key, $instance);
	}

	/**
	 * @param string 		$key
	 * @param array|object	$instance
	 * @return bool
	 */
	public function register($key, $instance)
	{
		$this->instances[$key] = $instance;
		return true;
	}

	/**
	 * @return self
	 */
	public static function getSelfInstance()
	{
		return self::$self;
	}
}
