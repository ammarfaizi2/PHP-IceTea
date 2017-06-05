<?php

namespace Console\Input;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class ArgvInput
{
	/**
	 *
	 * @var	array
	 */
	public $tokens;

	/**
	 *
	 * @var	string
	 */
	public $appName;

	/**
	 *
	 * @var	array
	 */
	public $optional;

	/**
	 *
	 * @var	array
	 */
	public $selection;

	/**
	 * 
	 * @var	string
	 */
	public $command;


	/**
	 *
	 * Constructor.
	 *
	 * @param	array|null	$argv	An array of parameters from the CLI (in the argv format)
	 *
	 */
	public function __construct(array $argv = null)
	{
		if ($argv === null) {
			$argv = $_SERVER['argv'];
		}

		$this->appName = $argv[0];

		/* strip the application name */
		array_shift($argv);


		$this->command = isset($argv[0]) ? $argv[0] : null;

		/* strip the command name */
		array_shift($argv);

		$this->tokens = $argv;
		$this->parse();
		var_dump($this);
	}

	private function parse()
	{
		$this->parseOptionalTokens();
		$this->parseSelectionTokens();
	}

	private function parseOptionalTokens()
	{
		foreach ($this->tokens as $v) {
			if (substr($v, 0, 2) === "--") {
				$this->optional[] = substr($v, 2);
			}
		}
	}

	private function parseSelectionTokens()
	{
		foreach ($this->tokens as $v) {
			if (substr($v, 0, 1) === "-") {
				$this->optional[] = substr($v, 1);
			}
		}
	}

	public function __toString()
	{
		return $this->appName . " " . implode(" ", $this->tokens);
	}
}