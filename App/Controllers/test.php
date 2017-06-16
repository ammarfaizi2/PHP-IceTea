<?php

namespace App\Controllers;

use System\Model;
use System\Controller;

use System\Crayner\Database\DB;


class test extends Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Default method.
	 */
	public function index()
	{
		DB::table("account_data")->where("userid", "48192012")->update(["verified"=>"true"]);
	}
}