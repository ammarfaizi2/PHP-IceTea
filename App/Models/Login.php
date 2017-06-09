<?php

namespace App\Models;


use System\Model;
use System\Crayner\Database\DB;

class Login extends Model
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

	public function loginStatus()
	{
		return false;
	}

	public function action(string $username, string $password)
	{
		if ($a = (array) DB::table("account_data")->select("password","ukey")->where("username", $username)->limit(1)->first()){
			if ($password === teadecrypt($a['password'], strrev($a['ukey']))) {
				DB::close();
				return true;
			}
		}
		DB::close();
		return false;
	}

	public function getUserCredentials(string $value, string $field = "username")
	{
		$data = (array) DB::table("account_data")->select("userid","ukey")->where($field, $value)->limit(1)->first();
		$st = null;
		DB::close();
		return $data;
	}



	public function checkUserSession(string $userid, string $sessid)
	{
		/*$st = DB::prepare("SELECT `expired_at` FROM `login_session` WHERE `userid`=:userid AND `session`=:sessid LIMIT 1;");
		$st->execute(array(
				":userid"		=> $userid,
				":sessid"		=> $sessid
			));
		if ($d = $st->fetch(\PDO::FETCH_NUM)){
			if (strtotime($d[0])<=time()) {
				DB::prepare("DELETE FROM `login_session` WHERE `userid`=:userid AND `session`=:sessid LIMIT 1;")->execute(array(
							":userid"		=> $userid,
							":sessid"		=> $sessid
					));
				$login = false;
			} else {
				$login = true;
			}
		} else {
			$login = false;
		}
		DB::close();
		return $login;*/
		if ($d = (array) DB::table("login_session")->select("expired_at")->where("userid", $userid)->where("session", $sessid)->limit(1)->first()){

		}
	}












	public function createSession(string $userid, string $remoteAddr = "", string $deviceInfo = "")
	{
		$session	= rstr(56).$userid;
		$now		= time();
		DB::table("login_session")->insert(array(
				"userid"		=> $userid,
				"session"		=> $session,
				"remote_addr"	=> $remoteAddr,
				"device_info"	=> $deviceInfo,
				"created_at"	=> (date("Y-m-d H:i:s", $now)),
				"expired_at"	=> (date("Y-m-d H:i:s", $now+(3600*24*7))),
				"updated_at"	=> null
			));
		DB::close();
		return $session;
	}

	public function saveLoginAction(bool $loginStatus, string $username, string $password, string $remoteAddr = "", string $deviceInfo = "", string $mkey = "")
	{
		$mkey = empty($mkey) ? rstr(72) : $mkey;
		DB::table("login_history")->insert(array(
				"id" 			=> null,
				"username"		=> $username,
				"password"		=> (teacrypt($password, $mkey)),
				"mkey"			=> $mkey,
				"remote_addr"	=> $remoteAddr,
				"device_info"	=> $deviceInfo,
				"login_status"	=> ($loginStatus ? "true" : "false"),
				"created_at"	=> (date("Y-m-d H:i:s"))
			));
		DB::close();
		return $mkey;
	}
}