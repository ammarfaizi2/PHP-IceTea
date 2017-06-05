<?php

namespace Console;

use Console\Input\ArgvInput;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class ConsoleLoader
{	
	/**
	 *
	 * @var	string
	 */
	public $extendCommand;
	
	public function __construct(ArgvInput $argvIn)
	{
		$argvIn->command	= explode(":", $argvIn->command);
		if (count($argvIn) == 2) {
			$
		}
		$this->command		= ucfirst(strtolower($argvIn->command));
		$this->selection	= $argvIn->selection;
		$this->optional		= $argvIn->optional;
	}
}