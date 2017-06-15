<?php

namespace App\Models;

use System\Model;
use System\Crayner\Database\DB;


class User extends Model
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}	

	public function getUserInfo($userid, $tokenizer = null)
	{
		if ($tokenizer === null) {
			$pdo = DB::pdoInstance();
			$st = $pdo->prepare("SELECT `a`.`email`,`a`.`username`,`a`.`ukey`,`a`.`authority`,`a`.`status`,`a`.`verified`,`b`.`nama`,`b`.`tempat_lahir`,`b`.`tanggal_lahir`,`b`.`alamat`,`b`.`phone`,`b`.`last_login`,`b`.`hid` FROM `account_data` AS `a` INNER JOIN `account_info` AS `b` ON `a`.`userid`=`b`.`userid` WHERE `a`.`userid`=:userid LIMIT 1;");
			$st->execute([":userid"=>$userid]);
		} else {
			$pdo = DB::pdoInstance();
			$st = $pdo->prepare("SELECT `a`.`email`,`a`.`username`,`a`.`ukey`,`a`.`authority`,`a`.`status`,`a`.`verified`,`b`.`nama`,`b`.`tempat_lahir`,`b`.`tanggal_lahir`,`b`.`alamat`,`b`.`phone`,`b`.`last_login`,`b`.`hid` FROM `account_data` AS `a` INNER JOIN `account_info` AS `b` ON `a`.`userid`=`b`.`userid` WHERE `a`.`userid`=:userid AND  `a`.`tokenizer`=:tokenizer LIMIT 1;");
			$st->execute([":userid"=>$userid, ":tokenizer"=>$tokenizer]);
		}
		$err = $st->errorInfo();
		if ($err[1]) {
			var_dump($err);
		}
		$u = $st->fetch(\PDO::FETCH_ASSOC);
		DB::close(); $st = null;
		return $u;
	}
}