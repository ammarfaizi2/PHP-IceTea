<?php

namespace Console;

use Console\ConsoleLoader;
use Console\Input\ArgvInput;

class IceTea
{
    /**
     *
     * @var	string
     */
    public $status;

    
    public function run(ArgvInput $input, ConsoleLoader $loader)
    {
    	$commandClass = "\\Console\\Commands\\{$loader->command}";
    	if (!class_exists($commandClass)) {
    		
    	}
    	
    	$ex = new $commandClass();
    	$ex->prepare($loader->selection, $loader->optional, $loader->extendCommand);
    	$ex->argument($input->tokens);
    	$ex->execute();
    	$output = $ex->showResult();

    	unset($ex);
    }
}
