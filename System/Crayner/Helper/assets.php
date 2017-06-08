<?php
use System\Crayner\ConfigHandler\Configer;

if (!function_exists('js')) {
    function js($file, $abs=false)
    {
        print '<script type="text/javascript" src="'.(Configer::asset('js')).'/'.($abs?$file:$file.'.js').'?t='.time().'"></script>'."\n";
    }
}
if (!function_exists('css')) {
    function css($file, $abs=false)
    {
        print '<link rel="stylesheet" type="text/css" href="'.(Configer::asset('css')).'/'.($abs?$file:$file.'.css').'?t='.time().'">'."\n";
    }
}
