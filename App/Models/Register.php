<?php

namespace App\Models;

use System\Model;
use System\Crayner\Database\DB;


class Register extends Model
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function store_to_db($data)
	{
		DB::table("account_data")->insert([
				""
			]);
	}

	public $alert;

	public function validDB($data)
	{
		$this->dt = $data;
		return true;
	}
}