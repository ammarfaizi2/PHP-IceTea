<?php

namespace IceTea\Web;

use Exception;
use IceTea\View\View;
use IceTea\Routing\Router;
use IceTea\View\ViewFoundation;
use IceTea\Routing\RouteBinding;
use IceTea\Routing\RouteCollector;
use IceTea\Exceptions\AbsoluteException;
use IceTea\Exceptions\Http\NotFoundException;
use IceTea\Foundation\Http\NotFoundFoundation;
use App\Exceptions\Handler as ExceptionHandler;
use IceTea\Foundation\Exceptions\Handler\HttpExceptionHandler;

final class Web
{
    public function __construct()
    {

    }

    public function routeHandle()
    {
        RouteCollector::loadRoutes();
        $route = new Router();
        try {
            $action = $route->fire();
        } catch (Exception $e) {
            $action = new ExceptionHandler($e);
            $action = new HttpExceptionHandler($action->handle());
            $action = $action->handle();
        }
        RouteBinding::destroy();
        RouteCollector::destroy();
        if ($action instanceof ViewFoundation) {
            View::make($action);
        } elseif ($action instanceof NotFoundFoundation) {
            throw new NotFoundException("Page not found", 1);
        } elseif (is_null($action)) {
        } elseif (get_class($action) === Exception::class) {
            http_response_code(500);
            throw new AbsoluteException($action->getMessage(), 1);
        }
    }

    public function terminate()
    {
    }
}
