<?php

namespace System\Database;

use PDO;
use System\Hub\Singleton;
use System\Contracts\Database\QueryBuilder;
use System\Foundation\Database\DatabaseFactory;

class DB extends DatabaseFactory implements QueryBuilder
{
    use Singleton;
    
    /**
     * @var PDO
     */
    private $pdo;


    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";port=".DBPORT, DBUSER, DBPASS);
    }

    public static function __callStatic($a, $b)
    {
        return self::getInstance()->pdo->{$a}(...$b);
    }
}
