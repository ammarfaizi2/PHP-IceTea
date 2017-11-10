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
    }
}//end class
