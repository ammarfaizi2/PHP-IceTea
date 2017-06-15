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

	public function getUserInfo($userid)
	{
		$pdo = DB::pdoInstance();
		$st = $pdo->prepare("SELECT `a`.`email`,`a`.`username`,`a`.`ukey`,`a`.`authority`,`a`.`status`,`a`.`verified`,`b`.`nama`,`b`.`tempat_lahir`,`b`.`tanggal_lahir`,`b`.`alamat`,`b`.`phone`,`b`.`last_login`,`b`.`hid` FROM `account_data` AS `a` INNER JOIN `account_info` AS `B` ON `a`.`userid`=`b`.`userid` WHERE `a`.`userid`=:userid LIMIT 1;");
		$st->execute([":userid"=>$userid]);
		if ($err = $st->errorInfo()) {
			var_dump($err);
		}
		return $st->fetch(\PDO::FETCH_ASSOC);
	}
}