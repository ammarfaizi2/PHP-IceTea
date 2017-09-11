<?php

namespace App\Controllers;

class TestController
{
	public function index($param)
	{
		view("welcome", ["title"=>"Lorem ipsum"]);
	}

	public function testRandomString()
	{
		print rstr(32, "abc");
	}

	public function testEncrypt()
	{
		print "encrypted = "; print var_dump($dec = encice("Hello World !", "ammar"))."<br>";
		print "decrypted = ";var_dump(decice($dec, "ammar"));
	}
}
