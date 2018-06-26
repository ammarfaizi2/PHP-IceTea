<?php

namespace IceTea\Foundation;

final class AliasLoader
{
	/**
	 * @var array
	 */
	private $aliases = [];

	/**
	 * Constructor.
	 *
	 * @param array $aliases
	 * @return void
	 */
	public function __construct($aliases)
	{
		$this->aliases = $aliases;
	}

	/**
	 * @return void
	 */
	public function load()
	{
		spl_autoload_register([$this, "aliasHandler"]);
	}

	/**
	 * @param string $class
	 * @return void
	 */
	private function aliasHandler($class)
	{
		if (array_key_exists($class, $this->aliases)) {
			class_alias($this->aliases[$class], $class);
		}
	}
}
