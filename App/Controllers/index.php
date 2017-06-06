<?php

namespace App\Controllers;

use System\Controller;
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
    }

    /**
     *
     * Default method.
     *
     */
    public function index()
    {
        var_dump($this->input->post("asd")->escape());
    }
}
