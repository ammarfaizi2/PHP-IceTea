<?php

namespace System;

use System\Loader;
use System\Crayner\Set\Set;
use System\Crayner\Get\Get;
use System\Crayner\Hub\Singleton;
use System\Crayner\Input\InputHandler;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Controller
{
    use Singleton;
    
    public function __construct()
    {
        $this->load  = new Loader();
        $this->input = new InputHandler();
        $this->set   = new Set();
        $this->get   = new Get();
    }
}
