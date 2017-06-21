<?php

namespace System;

use System\Router;
use System\Controller;
use System\Crayner\Hub\Singleton;
use System\Crayner\ConfigHandler\Configer;
use System\Crayner\URLManagement\UriSegment;
use System\Exception\MethodNotAllowedHttpException;

/**
 *
 * @author    Ammar Faizi    <ammarfaizi2@gmail.com>
 */

class Crayner
{
    use Singleton;

    /**
     * @var array
     */
    private $segments;

    /**
     *
     * @var    string
     */
    private $firstSegment;

    /**
     *
     * @var string
     */
    private $secondSegment;

    /**
     *
     * @var    array
     */
    private $optionalSegment;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->segments        = UriSegment::getSegments(Configer::routerFile());
        $this->firstSegment        = UriSegment::getSegment(1, $this->segments);
        $this->secondSegment    = UriSegment::getSegment(2, $this->segments);
        $this->optionalSegment    = array_diff($this->segments, array('', $this->firstSegment, $this->secondSegment));
    }

    public static function run()
    {
        self::getInstance()->_run();
    }

    public static function getURI()
    {
        return self::getInstance()->segments;
    }

    /**
     * Here we go...
     */
    public function _run()
    {
        if (defined("NOT_FOUND")) {
            (new Controller())->load->error(404);
        }
        if (Configer::manualRoute()) {
            
            // $this->segments[0] = "/";
        
            $router = Router::getInstance($this->segments);
            Configer::loadRoutes();
            try {
                if ($action = $router->run()) {
                    if (is_array($action)) {
                        $class = "App\\Controllers\\{$action['controller']}";
                        if (class_exists($class) and $class = new $class() and is_callable(array($class, $action['method']))) {
                            $class->{$action['method']}();
                        } else {
                            (new Controller())->load->error(404);
                        }
                    } else {
                        (new Controller())->load->error(404);
                    }
                }
            } catch (MethodNotAllowedHttpException $e) {
                print "MethodNotAllowedHttpException : ".$e->getMessage();
            }
            
            die;
        }
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
