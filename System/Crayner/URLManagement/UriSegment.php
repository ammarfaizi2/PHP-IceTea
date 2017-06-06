<?php

namespace System\Crayner\URLManagement;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class UriSegment
{
    /**
     *   @param  string  $router
     *   @return array
     */
    public static function getSegments($router='index.php')
    {
        if (!empty($router) && strpos($_SERVER['REQUEST_URI'], $router)!==false) {
            $from = explode($router, $_SERVER['REQUEST_URI']);
            $from = $from[1];
        } else {
            $from = $_SERVER['REQUEST_URI'];
        }
        return explode("/", parse_url($from, PHP_URL_PATH));
    }

    /**
     *   @param  int     $n
     *   @param  array   $segs
     *   @return string
     */
    public static function getSegment($n, $segs)
    {
        $c = count($segs);
        return isset($segs[$n]) && !empty($segs[$n]) ?$segs[$n]: '';
    }
}
