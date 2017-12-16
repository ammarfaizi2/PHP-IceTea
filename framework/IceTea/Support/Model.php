<?php

namespace IceTea\Support;

use IceTea\Utils\convArrig;
class Model
{
    protected
        $pdo,
        $table,
        $where,
        $whereData,
        $order,
        $limit;
    public function __construct(){
        $this->pdo = new \PDO(
            $convArrig['driver'].":host=".$convArrig['host'].";dbname=".$convArrig['dbname'].";port=".$convArrig['port'],
            $convArrig['user'],
            $convArrig['pass'],
            [
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
            ]
        );
    }
    public function exec($sql,$data){

        $data = (isset($this->whereData))? array_merge($this->whereData,$data):$data;
        $prepare = $this->pdo->prepare($sql.$this->where.$this->order.$this->limit);
        $prepare->execute($data);
        $this->clean();
        return $prepare;
    }
    public function clean(){
        $this->where = null;
        $this->whereData = [];
        $this->order = null;
        $this->limit=null;
        return $this;
    }
    //Preprocess Data
    public function table($table){
        $this->table = $table;
    }
    public function select(){
        $this->select = implode(',',func_get_args());
        return $this;
    }
    public function where(array $data,$type='AND'){
        $dat = $this->convArr($data,'w_');
        $where = array_keys($dat);
        $this->where = 'WHERE ';
        $jml = count($data)-1;
        $i = 0;
        foreach ($data as $key => $value) {
            $this->where .= $key.' = :w_'.$key;
            if($i < $jml){
                $this->where .= ' '.$type.' ';
            }
            $i++;
        }
        $this->whereData = $dat;
    }

    public function orderBy($column, $sort){
        $this->order = " ORDER BY {$column} {$sort}";
		return $this;
    }
    public function limit($limit, $offset = null) {
		$offset = (!empty($offset)) ? 'OFFSET '.$offset : null;
		$this->limit = " LIMIT {$limit} ".$offset;
		return $this;
	}
    //Get Data
    public function get(){
        $select = (isset($this->select))? $this->select : '*';
        $sql = "SELECT ".$select." FROM ".$this->table;
        return $this->exec($sql,[])->fetchAll(PDO::FETCH_OBJ);
    }
    public function first(){
        $select = (isset($this->select))? $this->select : '*';
        $sql = "SELECT ".$select." FROM ".$this->table;
        return $this->exec($sql,[])->fetch(PDO::FETCH_OBJ);
    }

    // Create Update Delete
    public function insert(array $data){
        $sql = "INSERT INTO ".$this->table;
        $sql .= "(".implode(',',array_keys($data)).')';
        $data = $this->convArr($data);
        $sql .= " VALUES(".implode(',',array_keys($data)).")";
        return $this->exec($sql,$data);
    }
    public function update(array $data){
        $newData = $this->convStr($data);
        $sql = "UPDATE ".$this->table." SET {$newData[0]} ";

        return $this->exec($sql,$newData[1]);
    }
    public function delete(){
        $sql = "DELETE FROM ".$this->table.' ';
        $this->exec($sql,[]);
    }
    // Data Convert
    private function convArr($data,$p=''){
        foreach($data as $key=>$v){
            $m[':'.$p.$key] = $v;
        }
        return $m;
    }
    private function convStr($data){
        foreach($data as $k => $k_v):
            $m[] = $k."=:{$k}";
        endforeach;
        $m = implode(",", $m);
        return [$m, $this->convArr($data)];
    }
}
