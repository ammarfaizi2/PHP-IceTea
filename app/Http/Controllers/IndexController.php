<?php

namespace App\Http\Controllers;

use DB;
use Request;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
    }

    public function index(Request $r)
    {
    	// $s = "9_jSG8IJjTbYyfwRVgpi_Q4B3lBKk8_3BhNbdm3R5aCkZjs6IMB9JSkphIHYitSg";
    	// $e = ice_encrypt($s, config("app.key"), 0);
    	// $d = ice_decrypt($e, config("app.key"), 0);
    	// dd($e, $d);
    	return view("welcome");
    }
}
