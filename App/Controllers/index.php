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
    }

    /**
     *
     * Default method.
     *
     */
    public function index()
    {
        $this->load->view("welcome");
    }
}
