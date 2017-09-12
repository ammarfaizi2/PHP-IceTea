<?php

namespace Console\Input;

class ArgvInput
{
	private $input;

	public function __construct()
	{
		$a = $_SERVER['argv'];
		array_shift($a);
		$this->input = $a;
	}

	public function getInput()
	{
		return $_SERVER['argv'];
	}

	public function execute()
	{
		if (count($this->input)) {
			
		} else {
			$this->showHelps();
		}
	}
}