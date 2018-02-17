<?php

namespace App\Http\Controllers;

use DB;
use Request;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    public function index(Request $r)
    {
    	header("Content-type:text/plain");
    	$st = DB::table("test")->select("user as pengguna")
    		->limit(1)->offset(1)->get();
    	var_dump($st);
    }
}
