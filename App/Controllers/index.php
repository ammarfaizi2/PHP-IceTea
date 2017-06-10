<?php

namespace App\Controllers;

use System\Controller;

use App\Models\Login;
use App\Controllers\login as loginpage;
use System\Crayner\Database\DB;

class index extends Controller
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->login = new loginpage();
    }

    /**
     * Default method.
     */
    public function index()
    {
        if ($this->login->checkLoginCookie()) {
            (new home())->index();
        } else {
            $this->login->index();
        }

        /*print_r(DB::table('posts')->get());*/
    }
}
