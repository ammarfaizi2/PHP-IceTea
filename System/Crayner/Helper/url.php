<?php
use System\Crayner\ConfigHandler\Configer;

if (!function_exists('base_url')) {
    function base_url()
    {
        return BASEURL;
    }
}

if (!function_exists('router_url')) {
    function router_url()
    {
        $a = Configer::routerFile();
        return BASEURL . (empty($a) ? '' : '/' . $a) ;
    }
}
