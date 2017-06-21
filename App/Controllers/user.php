<?php

namespace App\Controllers;

use App\Models\Login;
use App\Models\User as UserModel;
use App\Controllers\login as loginController;
use System\Controller;

class user extends Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
        $this->load->helper("rstr");
        if (!(new loginController())->checkLoginCookie()) {
            header("Location: ".router_url()."/login?ref=usr&wg=".rstr(72));
            die("~");
        }
        $this->load->helper("assets");
        $this->uinfo = (new UserModel())->getUserInfo($this->get->cookie("uid")->decrypt($this->get->cookie("uk")->__toString())->__toString());
	}	

	public function userpage()
	{
		$uri = \System\Crayner::getURI();
		$this->load->view("user/main", ["page"=>$uri[1]]);
	}

	private function home()
	{
		
	}

	private function profile()
	{
        $this->load->view("user/profile", ["u"=>$this->uinfo]);
	}

	public function search()
	{
		$this->load->view("user/search");
	}

	public function ajax()
	{
		sleep(3);
		if (isset($_GET['init'])) {
			$this->{teadecrypt(teadecrypt($_GET['init']))}();
		} elseif (isset($_GET['load'])) {
			$this->{$_GET['load']}();
		} else {
			$this->load->error(404);
		}
	}
}