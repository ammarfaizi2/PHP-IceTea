<?php

namespace System\Crayner\Database;

use Sysyem\Crayner\Hub\Singleton;
use System\Crayner\ConfigHandler\Configer;
use System\Crayner\Builder\DatabaseFactory;

class DB extends DatabaseFactory
{
    use Singleton;

    public function __construct()
    {
        try {
            $conf = Configer::database();
            $this->pdo = new \PDO($conf['driver'].":host=".$conf['host'].";dbname=".$conf['dbname'], $conf['user'], $conf['pass'], array(
                    \PDO::ATTR_PERSISTENT => false
                ));
        } catch (\PDOException $e) {
        }
    }

    public static function insert(string $table, array $value)
    {
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
