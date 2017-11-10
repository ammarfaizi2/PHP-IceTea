<?php

namespace IceTea\Console;

final class Console
{
	public function run()
	{
		if ($this->parseInput()) {
			$this->parseCommand();
			$this->parseArguments();
			$this->parseOptionalArguments();
			$this->__run();
		}
	}

	private function parseInput()
	{
		$argv = $_SERVER['argv'];
		array_shift($argv);
		if (empty($argv)) {
			$this->intro();
			return false;
		}
	}

	private function intro()
	{
		$intro = new Intro();
		$intro->buildContext();
		$intro->show();
	}

	public function terminate()
	{
	}
}