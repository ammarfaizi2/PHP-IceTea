<?php

namespace IceTea\Console;

final class MainHandler
{
	private $run = [];

    public function __construct($run)
    {
    	$this->run = $run;
    }//end __construct()

    public function __invoke()
    {
    	$this->run['cmd']['action'] = "\\".$this->run['cmd']['action'];
    	$console = new $this->run['cmd']['action']($this->run);
    	$console->run();
    }
}//end class
