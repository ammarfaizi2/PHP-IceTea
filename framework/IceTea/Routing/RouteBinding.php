<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;

final class RouteBinding
{
    use Singleton;

    /**
     * @var array
     */
    private $binded = [];

    public function __construct()
    {
    }

    public static function bind($key, $val)
    {
        $ins = self::getInstance();
        $ins->binded[$key] = $val;
    }
    
    public function getBindedValue()
    {
        return new BindedValue(self::getInstance()->binded);
    }

    public static function destroy()
    {
        $ins = self::getInstance();
        $ins->binded = [];
    }
}
