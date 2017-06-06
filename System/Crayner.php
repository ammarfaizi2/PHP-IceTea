<?php

namespace System;

use System\Controller;
use System\Crayner\ConfigHandler\Configer;
use System\Crayner\URLManagement\UriSegment;

/**
 *
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 *
 */

class Crayner
{
    /**
     * @var array
     */
    private $segments;

    /**
     *
     * @var	string
     */
    private $firstSegment;

    /**
     *
     * @var string
     */
    private $secondSegment;

    /**
     *
     * @var	array
     */
    private $optionalSegment;

    /**
     *
     * Constructor.
     *
     *
     */
    public function __construct()
    {
        $this->segments        = UriSegment::getSegments(Configer::routerFile());
        $this->firstSegment        = UriSegment::getSegment(1, $this->segments);
        $this->secondSegment    = UriSegment::getSegment(2, $this->segments);
        $this->optionalSegment    = array_diff($this->segments, array('', $this->firstSegment, $this->secondSegment));
    }

    /**
     *
     * Here we go...
     *
     */
    public function run()
    {
        if (Configer::automaticRoute()) {
            $this->firstSegment        = empty($this->firstSegment) ? Configer::defaultRoute() : $this->firstSegment;
            $this->secondSegment    = empty($this->secondSegment) ? Configer::defaultMethod() : $this->secondSegment;
            $class = "App\\Controllers\\{$this->firstSegment}";
            if (class_exists($class) and $class = new $class() and is_callable(array($class, $this->secondSegment))) {
                $class->{$this->secondSegment}();
            } else {
                (new Controller())->load->error(404);
            }
        }
    }
}
