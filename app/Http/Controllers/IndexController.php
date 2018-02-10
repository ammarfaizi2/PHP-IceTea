<?php

namespace App\Http\Controllers;

use Request;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function index()
    {
        var_dump($this->request);
    }
}
