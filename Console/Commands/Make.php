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
			} else {
				$this->filename = $argument;
			}
		} catch (InvalidArgumentException $e) {
			print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
			die;
		} catch (\Exception $e) {
			print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
		}
    }


    private function makeFile($template, $filename, $function = null)
    {
    	$fileContent = file_get_contents(TEMPLATE_DIR . '/' . $template . '.ice');
    	if ($function !== null) {
    		$fileContent = $function($file);
    	}
    	file_put_contents($filename, $fileContent);
    }

    public function execute()
    {
    	switch ($this->command) {
    		case 'controller':
    				$this->makeFile("controller", APP_DIR . '/Controllers/' . $this->filename, function($str){
    					return str_replace("~~~controller_name~~~", $this->filename, $str);
    				});
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
