<?php

namespace Console;

use Console\Input\ArgvInput;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class ConsoleLoader
{
	public function __construct(ArgvInput $argvIn)
	{
		print_r($argvIn);
	}
}