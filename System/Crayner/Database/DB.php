<?php

namespace System\Crayner\Database;

use System\Crayner\Hub\Singleton;
use System\Crayner\ConfigHandler\Configer;
use System\Crayner\Builder\Database\DatabaseFactory;

class DB extends DatabaseFactory
{
    use Singleton;

    /**
     *
     * @var bool
     */
    private $showErrorQuery;

    /**
     *
     * Constructor.
     *
     *
     *
     */
    public function __construct()
    {   
        $this->showErrorQuery = Configer::errorQuery();
        try {
            $conf = Configer::database();
            $this->pdo = new \PDO($conf['driver'].":host=".$conf['host'].";dbname=".$conf['dbname'], $conf['user'], $conf['pass'], array(
                    \PDO::ATTR_PERSISTENT => false
                ));
        } catch (\PDOException $e) {

        }
    }

    /**
     *
     * Insert
     *
     * @param   string  $table
     * @param   array   $value
     * @return  bool
     */
    public static function insert(string $table, array $value)
    {
        $fields = "(";
        $bound  = "(";
        foreach ($value as $k => $v) {
            $fields .= "`{$k}`,";
            $bound  .= ":{$k},";
        }
        $fields = rtrim($fields, ",") . ")";
        $bound  = rtrim($bound, ",") . ")";
        $query  = "INSERT INTO {$table} {$fields} VALUES {$bound};";
        $self   = self::getInstance();
        $st     = $self->pdo->prepare($query);
        $exec   = $st->execute($value);
        $error  = $st->errorInfo();
        if ($error[1] and $self->showErrorQuery) {
            var_dump(array(
                    "Error" => $st->errorInfo()
                ));
        }
        $st = $self = null;
        return $exec;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * @todo Close PDO Connection.
     */
    public function close()
    {
        $this->pdo = null;
    }
}
