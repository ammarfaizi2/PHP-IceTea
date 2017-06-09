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
    protected $where = [], $whereData = [], $join = [], $table_name = null;

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
            $this->pdo = new \PDO($conf['driver'].":host=".$conf['host'].";port=".$conf['port'].";dbname=".$conf['dbname'], $conf['user'], $conf['pass'], array(
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
    /*public static function insert(string $table, array $value)
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
    }*/

    /**
     *
     * Insert
     *
     * @param   string  $statement
     * @return  \PDO
     */
    /*public static function prepare(string $statement, $data = array())
    {
        $self   = self::getInstance();
        $st     = $self->pdo->prepare($statement);
        $self   = null;
        return $st;
    }*/

    protected static function _execute(string $statement, array $data) 
    {
        $self      = self::getInstance();

        $statement = $self->makeStatement($statement);
        $make      = $self->pdo->prepare($statement);
        $data      = array_merge($data, $self->whereData);

        $make->execute($data);

        $error  = $make->errorInfo();
        if ($error[1] and $self->showErrorQuery) {
            var_dump(array(
                    "Error" => $make->errorInfo()
                ));
        }

        return $make;
    }

    protected static function makeStatement(string $statement)
    {
        $self  = self::getInstance();

        $where = (!empty($self->where)) ? " WHERE ". substr(implode("", $self->where), 4) : null;
        $join  = implode("", $self->join);

        $newStatement = $statement.$join.$where;

        return $newStatement;
    }

    protected static function makeInsertParameter(array $data) 
    {
        foreach($data as $field => $value) {
            $newData[":{$field}"] = $value;
        }

        return $newData;
    }

    protected static function makeUpdateParameter(array $data) 
    {
        
        foreach($data as $field => $value) {
            $newData[] = "{$field}=:{$field}";
        }

        $newData = implode(",", $m); // override new data

        return $newData;
    }

    public static function table(string $table) 
    {
        $self             = self::getInstance();
        $self->table_name = $table;

        return $self;
    }
   
    /**
     *
     * Update
     *
     * @param   array   $data
     * @return  boolean
     */
    public static function update(array $data) 
    {
        $self      = self::getInstance();

        $table     = $self->table_name;
        $param     = makeUpdateParameter($data);
        $value     = makeInsertParameter($data);

        $statement = "UPDATE {$table} SET {$param} ";
        $execute   = $self->execute($statement, $value);

        return $execute;
    }

    public static function where($column, $operator, $value = null, $type = " AND ") 
    {
        $self      = self::getInstance();

        $param     = str_replace(".", "_", $column); // remove table seperator for parameter
        $where     = (empty($value)) ? "{$column}=:where_{$param}" : "{$param} {$operator} :where_{$param}";
        $whereData = (empty($val)) ? $op : $val;

        array_push($self->where, $type.$where);
        array_merge($self->whereData, [":where_{$param}" => $whereData]);

        return $self;
    }

    public static function select() 
    {
        $self         = self::getInstance();
        $self->select = implode(",", func_get_args());

        return $self;
    }

    public static function get() 
    {
        $self   = self::getInstance();

        $select = (!empty($self->select)) ? $self->select : "*";

        $execute = $self->_execute("SELECT {$select} FROM {$self->table_name} ", []);

        return $execute->fetchAll(\PDO::FETCH_CLASS);
    }


    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * @todo Close \PDO Connection.
     */
    public static function close()
    {
        $self   = self::getInstance();
        $self->pdo = null;
    }
}
