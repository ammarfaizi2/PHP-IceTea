<?php

namespace App\Controllers;


use App\Models\Login;
use System\Controller;
use System\Crayner\Cookie\Cookie;

class index extends Controller
{
    /**
     *
     * Constructor.
     *
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("rstr");
        $this->load->helper("teacrypt");
        $this->cookie = Cookie::getInstance();
    }

    /**
     *
     * Default method.
     *
     */
    public function index()
    {
    }
}