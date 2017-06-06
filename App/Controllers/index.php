<?php

namespace App\Controllers;

use System\Controller;
use System\Crayner\Cookie\Cookie;;
use System\Crayner\Database\DB;

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
        print_r($_COOKIE);
        $this->cookie->make("qwe", "lagi males ngomong :v", 2000);
        print_r(wordwrap(PHP_EOL.rstr(90000), 100, "<br>"));
        print "no";
    }
}