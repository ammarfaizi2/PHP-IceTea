<?php

namespace System\Database;

use PDO;
use System\Hub\Singleton;

class DB extends DatabaseFactory
{
	use Singleton;
	
	/**
	 * @var PDO
	 */
	private $pdo;


	public function __construct()
	{
		$this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	}

	public static function __callStatic($a, $b)
	{
		return self::getInstance()->pdo->{$a}(...$b);
	}
}
