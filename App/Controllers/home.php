<?php

namespace App\Controllers;

use App\Models\Login;
use App\Controllers\login as loginController;
use System\Controller;

class home extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("rstr");
    }

    /**
     * Default method.
     */
    public function index()
    {
        if (!(new loginController())->checkLoginCookie()) {
            header("Location: ".router_url()."/login?ref=home&wg=".rstr(72));
        }
    }
}
