<?php

namespace IceTea\DotEnv;

use IceTea\Exceptions\DotEnvException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @package \IceTea\DotEnv
 * @version 0.0.1
 * @license MIT
 */
final class Loader
{
	/**
	 * @var string
	 */
	private $dotEnvFile;

	/**
	 * Constructor.
	 *
	 * @param string $dotEnvFile
	 * @throws \IceTea\Exceptions\DotEnvException
	 */
	public function __construct(string $dotEnvFile)
	{
		$this->dotEnvFile = $dotEnvFile;
	
		if (!file_exists($this->dotEnvFile)) {
			throw new DotEnvException(
				sprintf("Could not file dot env file: %s\n", $this->dotEnvFile)
			);
		}

		if (!is_readable($this->dotEnvFile)) {
			throw new DotEnvException(
				sprintf("Dot env file is not readable: %s\n", $this->dotEnvFile)
			);
		}
	}

	/**
	 * @return void
	 */
	public function load(): void
	{
		foreach(explode("\n", file_get_contents($this->dotEnvFile)) as $l) {
			$l = trim($l);
			if (!empty($l[0]) && $l[0] !== "#") {
				putenv($l);
			}
		}
	}
}
