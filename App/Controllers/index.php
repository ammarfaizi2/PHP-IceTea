<?php

namespace App\Controllers;

use System\Controller;

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
    }

    /**
     *
     * Default method.
     *
     */
    public function index()
    {
        echo rstr();
        $this->load->view("welcome");
    }
}
