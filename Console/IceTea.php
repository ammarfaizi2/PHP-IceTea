<?php

namespace Console;

use Console\ConsoleLoader;
use Console\Color\Message;
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
    	$ex->prepare($loader->optional, $loader->selection, $loader->extendCommand);
    	$ex->argument($input->tokens);
    	$ex->execute();
    	$output = $ex->showResult();
        $output = Message::{$output['type']}(
            $output['msg'], 
            (isset($output['title']) ? isset($output['title']) : null),
            (isset($output['file'])  ? isset($output['line'])  : null),
            (isset($output['line'])  ? isset($output['line'])  : null)
        );
    	unset($ex);
        die($output);
    }
}
