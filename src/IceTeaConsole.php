<?php

use Console\Input\ArgvInput;

class IceTeaConsole
{
    public static function run()
    {
    	$app = new ArgvInput();
    	$cmd = "\\Console\\Commands\\".$app->command;
    	$cmd = new $cmd;
    	$cmd->input($app->getInput());
    	if ($cmd->execute()) {
    		print $cmd->result();
    		do {
    			$cmd->input($app->getInput());
    			$r = $cmd->execute();
    			$cmd->result();
    		} while ($r);
    	} else {
    		die($cmd->result());
    	}
    }
}
