<?php

namespace Console\Color;

use Console\Color\Colors;

/**
 * @author	Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class Message
{
    public static function error($msg, $title = null, $file = null, $line = null)
    {
        if ($title === null) {
            $strlen  =  strlen($msg);
            $str     =  str_repeat(" ", $strlen+6)."\n";
            $str    .= "   " . $msg . "   \n";
            $str    .= str_repeat(" ", $strlen+6)."\n";
            return (new Colors())->stringColor($str, 'white', 'red');
        } else {
            $strlen  = strlen($title);
            $str     = str_repeat("-", $strlen+6)."\n";
            $str    .= "|".str_repeat(" ", $strlen+4)."|\n";
            $str    .= "|  " . $title . "  |\n";
            $str    .= "|".str_repeat(" ", $strlen+4)."|\n";
            $str    .= str_repeat("-", $strlen+6)."\n";
            $str    .= "Error message\t: " . $msg . "\n";
            if ($file !== null) {
                $str .= "File\t\t: ".$file."\n";
            }
            if ($line !== null) {
                $str .= "Line\t\t: ".$line."\n";
            }
            $str    .= str_repeat("\n", 10);
            $str     = (new Colors())->stringColor($str, 'white', 'red')."\n";
            return $str;
        }
    }

    public static function success($msg, $title = null, $file = null, $line = null)
    {
        if ($title === null) {
            $strlen  =  strlen($msg);
            $str     =  str_repeat(" ", $strlen+6)."\n";
            $str    .= "   " . $msg . "   \n";
            $str    .= str_repeat(" ", $strlen+6)."\n";
            return (new Colors())->stringColor($str, 'white', 'green');
        } else {
            $strlen  = strlen($title);
            $str     = str_repeat("-", $strlen+6)."\n";
            $str    .= "|".str_repeat(" ", $strlen+4)."|\n";
            $str    .= "|  " . $title . "  |\n";
            $str    .= "|".str_repeat(" ", $strlen+4)."|\n";
            $str    .= str_repeat("-", $strlen+6)."\n";
            $str    .= "Success message\t: " . $msg . "\n";
            if ($file !== null) {
                $str .= "File\t\t: ".$file."\n";
            }
            if ($line !== null) {
                $str .= "Line\t\t: ".$line."\n";
            }
            $str    .= str_repeat("\n", 10);
            $str     = (new Colors())->stringColor($str, 'white', 'green')."\n";
            return $str;
        }
    }
}
