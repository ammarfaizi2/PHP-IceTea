<?php

namespace IceTea\Console\Intro;

use IceTea\Console\Color;

class AvailableCommand
{
	public function buildContext()
	{
		$this->str = Color::clr("Available commands:", "brown");
		$this->str.= PHP_EOL . $this->make();
	}

	public function __toString()
	{
		return $this->str;
	}

	private function make()
	{
		return " ".Color::clr("make", "brown")."
  ".Color::clr("make:controller", "green")."      Create a new controller class
  ".Color::clr("make:model", "green")."           Create a new model class" . PHP_EOL;
	}
}