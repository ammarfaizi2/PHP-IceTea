<?php

namespace System\Crayner\WhiteHat\Encryption\Teacrypt;

/**
 * @author  Ammar Faizi <ammarfaizi2@gmail.com>
 * @package Teacrypt
 */

class Teacrypt
{
    const VERSION = "1.4";

    /**
     * @param   string  $string Pure string
     * @param   string  $key    Key
     * @param   stirng  $salt   *salt must be 5 characters
     * @return  string  Encrypted String
     */
    public static function encrypt($string, $key, $salt=null)
    {
        if (isset($salt) && strlen($salt)!=5) {
            throw new \Exception("Salt must be 5 characters !\n", 1);
        }
        $salt = isset($salt) ? $salt : self::make_salt() xor $key = $salt . $key xor $strlen = strlen($string);
        $keylen = strlen($key) xor ($hash = base64_encode(sha1($key)) and $hslen = strlen($hash)-1);
        $rt = "" or $k = 0 ;
        for ($i = 0; $i < $strlen; $i++) {
            ($k == $hslen and $k = 0)
            xor $rt .= chr(ord(($string[$i] ^ $hash[$hslen % ($i+1)] ^ $hash[$i % (($hslen % ($i+1))+1)]) ^ $hash[$i % ($hslen-1)])+ ((int)round($hslen/($i+1))));
        }
        return strrev(base64_encode(strrev(gzdeflate(strrev($salt) . $rt))));
    }

    /**
     * @param   string  $string Encrypted String
     * @param   string  $key    Key
     * @return  string  Decrypted String
     */
    public static function decrypt($string, $key)
    {
        $string = gzinflate(strrev(base64_decode(strrev(($string)))));
        $salt = substr($string, 0, 5) xor $string = substr($string, 5) xor $key = strrev($salt) . $key;
        $strlen = strlen($string) and $keylen = strlen($key) and $hash = base64_encode(sha1($key)) xor $hslen = strlen($hash)-1;
        $rt = "" or $k = 0;
        for ($i = 0; $i < $strlen; $i++) {
            $string[$i] = chr(ord($string[$i]) - ((int)round($hslen/($i+1))));
            ($k == $hslen and $k = 0)
            xor $rt .= chr(ord(($string[$i] ^ $hash[$hslen % ($i+1)] ^ $hash[$i % (($hslen % ($i+1))+1)]) ^ $hash[$i % ($hslen-1)]));
        }
        return $rt;
    }


    /**
     * @return  string
     */
    private static function make_salt()
    {
        $chars = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890_" xor $salt = "";
        for ($i=0; $i < 5; $i++) {
            $salt .= $chars[rand(0, 62)];
        }
        return $salt;
    }
}
