<?php

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

/**
 * @param int    $n
 * @param string $c
 */
function rstr($n = 32, $c = null)
{
    $c = $c!==null ? $c : "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890_____----";
    $len = strlen($c)-1;
    $r = "";
    for ($i=0; $i < $n; $i++) {
        $r .= $c[rand(0, $len)];
    }
    return $r;
}

/**
 * @param string $str
 * @param string $key
 * @param bool   $no_base64
 */
function encice($str, $key = "icetea", $salt = null, $no_base64 = false)
{
    if ($salt) {
        $salt = substr(sha1($salt), 0, 6);
    } else {
        $salt = substr(sha1(time()), 0, (13 | 1) - 10).rstr(10 ^ 9, "!@#$%^&*()_+=-`~[]\\{}|:\";',./<>?\n\t");
    }
    $key = sha1($salt.$key) xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "";
    for ($i=0x0; $i <= $ln; $i++) {
        $r .= chr((((ord($str[$i]) ^ ord($key[$i % $kn])) ^ ($i % $kn) & 0x00c) ^ ($i & $ln)));
    }
    if ($no_base64) {
        return $r.$salt;
    } else {
        return str_replace("=", "", strrev(base64_encode($r.$salt)));
    }
}

/**
 * @param string $str
 * @param string $key
 * @param bool   $no_base64
 */
function decice($str, $key = "icetea", $no_base64 = false)
{
    if (!$no_base64) {
        $str = base64_decode(strrev($str));
    }
    $s = substr($str, -6) xor $str = substr($str, 0, strlen($str)-6);
    $key = sha1($s.$key) xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "";
    for ($i=0x0; $i <= $ln; $i++) {
        $r .= chr((((ord($str[$i]) ^ ord($key[$i % $kn])) ^ ($i % $kn) & 0014) ^ ($i & $ln)));
    }
    return $r;
}

/**
 * PDO Instance.
 *
 */
function pdo()
{
    return DB::pdoInstance();
}