<?php

namespace Console;

use Console\Color\Message;
use Console\Input\ArgvInput;
use Console\Exception\InvalidArgumentException;

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
    
    /**
     *
     * @param	Console\Input\ArgvInput	$argvIn
     * @throws	Console\Exception\InvalidArgumentException
     */
    public function __construct(ArgvInput $argvIn)
    {
        $argvIn->command    = explode(":", $argvIn->command);
        try {
            if (count($argvIn->command) == 2) {
                $this->extendCommand = $argvIn->command[1];
            } elseif (count($argvIn->command) == 1) {
                $this->extendCommand = null;
            } else {
                throw new InvalidArgumentException("Invalid command " .implode(":", $argvIn->command), 400);
            }
        } catch (InvalidArgumentException $e) {
            print Message::error($e->getMessage(), "InvalidArgumentException", $e->getFile(), $e->getLine());
            die;
        } catch (\Exception $e) {
            print Message::error($e->getMessage(), "\\Exception", $e->getFile(), $e->getLine());
        }
        $argvIn->command    = $argvIn->command[0];
        $this->command        = ucfirst(strtolower($argvIn->command));
        $this->selection    = $argvIn->selection;
        $this->optional        = $argvIn->optional;
    }
}
