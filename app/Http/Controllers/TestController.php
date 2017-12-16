<?php

namespace App\Http\Controllers;

use IceTea\Http\Controller;

class TestController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
