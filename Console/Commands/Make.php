<?php

namespace Console\Commands;

use Console\Color\Message;	
use System\Crayner\Contracts\Console\Command;
use Console\Exception\InvalidArgumentException;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Make implements Command
{
    /**
     *
     *
     */
    public function prepare($selection, $optional, $command)
    {
    	$this->selection = $selection;
        $this->command   = strtolower($command);
        $this->optional  = $optional;
    }

    public function argument($argument)
    {
    	try {
			if (count($argument) > 1) {
				throw new InvalidArgumentException("Invalid command argument !", 400);
			}
		} catch (InvalidArgumentException $e) {
			print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
			die;
		} catch (\Exception $e) {
			print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
		}
    }


    private function makeFile($template, $name, $function = null)
    {
    	$file = file_get_contents(filename)
    }

    public function execute()
    {
    	switch ($this->command) {
    		case 'controller':
    				
    			break;
    		case 'model':

    			break;
    		default:
    			# code...
    			break;
    	}
    }


    public function showResult()
    {
    }
}
