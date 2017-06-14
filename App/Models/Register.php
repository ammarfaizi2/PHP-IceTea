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

	private function genUserId()
	{
		$pdo = DB::pdoInstance();
		$st = $pdo->prepare("SELECT `userid` FROM `account_data` WHERE `userid`=:userid LIMIT 1;");
		do {
			$userid = rstr(10, "1234567890", 1);;
			$st->execute([":userid"=>$userid]);
		} while ($st->fetch(\PDO::FETCH_NUM));
		return $userid;
	}

	public function store()
	{
		$data = $this->dt;
		$userid = $this->genUserId();
		$time_reg = date("Y-m-d H:i:s");
		$key = rstr(72-strlen($userid)).$userid;
		DB::table("account_data")->insert([
				"userid" 		=> $userid,
				"username"		=> $data['username'],
				"password"		=> teacrypt($data['password'], strrev($key)),
				"ukey"			=> $key,
				"authority" 	=> "user",
				"status"		=> "active",
				"verified"		=> "false",
				"created_at"	=> $time_reg
			]);
		DB::table("account_info")->insert([
				"userid"		=> $userid,
				"nama"			=> $data['nama'],
				"tempat_lahir"	=> $data['tempat_lahir'],
				"tanggal_lahir"	=> $data['tanggal_lahir'],
				"alamat"		=> $data['alamat'],
				"phone"			=> $data['phone'],
				"last_login"	=> null,
				"hid"			=> null
			]);
		$token = rstr(144);
		$tkey  = rstr(72);
		DB::table("pending_account")->insert([
				"userid"		=> $userid,
				"token"			=> teacrypt($token, $tkey),
				"tkey"			=> $tkey,
				"expired"		=> $time_reg
			]);
		DB::close();
	}

	public $alert;

	public function validDB($data)
	{
		$this->dt = $data;
		return true;
	}
}