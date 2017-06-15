<?php

use System\Crayner\WhiteHat\Encryption\Teacrypt\Teacrypt;

if (!function_exists("teacrypt")) {
    /**
     *
     * @param  string $string
     * @param  string $key
     * @return string
     */
    function teacrypt(string $string, string $key = "icetea")
    {
        return Teacrypt::encrypt($string, $key."\x63\x72\x61\x79\x6e\x65\x72");
    }
}

if (!function_exists("teadecrypt")) {
    /**
     *
     * @param  string $string
     * @param  string $key
     * @return string
     */
    function teadecrypt(string $string, string $key = "icetea")
    {
        return Teacrypt::decrypt($string, $key."\x63\x72\x61\x79\x6e\x65\x72");
    }
}
