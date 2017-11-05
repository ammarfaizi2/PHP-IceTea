<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;
use App\Providers\RouteServiceProvider;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class RouteCollector
{
    use Singleton;

    /**
     * Routes
     *
     * @var array
     */
    private $routes = [];


    public function __construct()
    {
    }

    public static function collect($route, $action, $method)
    {
        $ins = self::getInstance();
        $ins->routes[$route][$method] = $action;
    }

    public static function loadRoutes()
    {
        $app = new RouteServiceProvider();
        $app->boot();
        $app->map();
    }

    public static function getRoutes()
    {
        return self::getInstance()->routes;
    }
}

/**
 * Scope isolated.
 * Prevent access $this or self from included file.
 */
function includer($file)
{
    //use IceTea\Routing\Route;
    require $file;
}
