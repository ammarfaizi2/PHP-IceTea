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
    }

    /**
     *
     * Default method.
     *
     */
    public function index()
    {
        $this->load->view("welcome");
        DB::insert("data", array("no"=>1, "buku"=>rstr()));
    }
}
