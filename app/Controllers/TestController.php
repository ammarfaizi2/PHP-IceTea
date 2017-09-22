<?php

/**
 * IceTea Framework
 */

namespace App\Controllers;

use Handler\IceTeaController;

class TestController extends IceTeaController
{
    public function index($param)
    {
        view("welcome", ["title"=>"Lorem ipsum"]);
    }

    public function testRandomString()
    {
        print rstr(100, "__.");
    }

    public function testEncrypt()
    {
        $a = rstr(32, "a");
        for ($i=0; $i < 1; $i++) {
            print "encrypted = ";
            print var_dump($dec = encice($a, "a"))."<br>";
            print "decrypted = ";
            var_dump(decice($dec, "a"));
            print "<br><br>";
        }
    }
}
