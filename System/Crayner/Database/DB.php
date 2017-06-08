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
     * Override singleton
     *
     */
    public static function getInstance()
    {
        if (self::$instance === null || !((self::$instance)->pdo  instanceof \PDO)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

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

    /**
     *
     * Insert
     *
     * @param   string  $statement
     * @return  \PDO
     */
    public static function prepare(string $statement)
    {
        $self   = self::getInstance();
        $st     = $self->pdo->prepare($statement);
        $self   = null;
        return $st;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * @todo Close PDO Connection.
     */
    public static function close()
    {
        $self   = self::getInstance();
        $self->pdo = null;
    }
}
