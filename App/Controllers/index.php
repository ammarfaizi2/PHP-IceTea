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
        /*if (isset($_COOKIE['registered_user'], $_COOKIE['tokenizer'])) {
            $this->set->cookie("registered_user", "", 0);
            $this->set->cookie("tokenizer", "", 0);
        }
        if ($this->login->checkLoginCookie()) {
            (new home())->index();
        } else {
            $this->login->index();
        }*/

        $user = DB::table('user')->where('user','arbiyanto')->orWhere([
            ['votes','=','3']
        ])->get();

        print_r($user);

        /*print_r(DB::table('posts')->get());*/
    }
}
