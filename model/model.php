<?php

namespace Model;

use Config\Database;
use Config\Factory;
use \PDO;

abstract class Model{

    protected $table;

    public function __construct(array $datas){
        $explode = explode('\\', get_class($this));
        $class_name = lcfirst(end($explode));
        $this->table = $class_name;
        $this->hydrate($datas);
    }
    
    protected static function _getAll($table, $select, $where, $limit, $order){
        $db = Database::dbConnect();
        $sql = 'SELECT'.$select.'FROM '.$table;
        if ($where != ''){
            $sql .= ' WHERE '.$where.$limit;
        }
        $sql .= $order;

        $req = $db->query($sql);
    
        $res = [];

        while ($line = $req->fetch()){
            array_push($res, static::buildModel($line));
        }

        return $res;
    }

    protected static function _getInner($table, $select, $inner, $where, $limit, $order, $param = []){
        $db = Database::dbConnect();
        $sql = 'SELECT'.$select.'FROM '.$table.$inner;
        if ($where != ''){
            $sql .= ' WHERE '.$where.$limit;
        }
        $sql .= $order;

        $req = $db->prepare($sql);

        foreach($param as $p) {
            if(isset($p['type']))
                $req->bindValue($p['key'], $p['value'], $p['type']);
            else
                $req->bindValue($p['key'], $p['value']);
        }
    
        $r = $req->execute();

        $res = array();

        while ($line = $req->fetch()){
            array_push($res, static::buildInner($line));
        }

        return $res;
    }

    protected static function _getOne($table, $select, $inner, $where, array $param = []){
        $db = Database::dbConnect();
        $sql = 'SELECT'.$select.'FROM '.$table.$inner.'WHERE '.$where;
        $req = $db->prepare($sql);

        foreach($param as $p) {
            if(isset($p['type']))
                $req->bindValue($p['key'], $p['value'], $p['type']);
            else
                $req->bindValue($p['key'], $p['value']);
        }

        $r = $req->execute();

        if($r != false && $req->rowCount() > 0) {
            return static::buildModel($req->fetch());
        } 
        else {
            return false;
        }

    }

    protected static function _create($table, array $values) {
        $db = Database::dbConnect();
        $sql = "INSERT INTO ".$table." (";
  
        $start = true;
        foreach($values as $p) {
            if(!$start) {
                $sql.=", ".$p['key'];
            } else {
                $sql.=$p['key'];
                $start = false;
            }
        }

        $sql.=") VALUES (";
        $start = true;        
        foreach($values as $p) {
            if(!$start) {
                $sql.=", :".$p['key'];
            } else {
                $sql.=":".$p['key'];
                $start = false;
            }
        }
        $sql.=")";

        $req = $db->prepare($sql);

        foreach($values as $p) {
            if(isset($p['type']))
            $req->bindValue(":".$p['key'], $p['value'], $p['type']);
        else
            $req->bindValue(":".$p['key'], $p['value']);
        }

        $res = $req->execute();

        return [ 'id' => $db->lastInsertId(), 'count' => ($res != false) ? $req->rowCount() : -1];
    }

    protected static function _update($table, $set, $where, $param = []){
        $db = Database::dbConnect();
        $sql = 'UPDATE '.$table.' SET '.$set.' WHERE '.$where;
        $req = $db->prepare($sql);
        $req->execute($param);

        return true;
    }

    protected static function _count($table, $where, $param = []){
        $db = Database::dbConnect();
        $sql = 'SELECT COUNT(*) as nb FROM '.$table;
        if ($where != ''){
            $sql .= ' WHERE '.$where;
        }
        $req = $db->prepare($sql);

        foreach($param as $p) {
            if(isset($p['type']))
            {
                $req->bindValue($p['key'], $p['value'], $p['type']);
            } 
            else
            {
                $req->bindValue($p['key'], $p['value']);
            }
                
        }
        
        $req->execute();
        $line = $req->fetch();
        return $line['nb'];
    }

    protected static function _delete($table, $alias, $inner, $where = "", array $param = []) {
        $db = Database::dbConnect();
        $sql = "DELETE ".$alias." FROM ".$table;

        if ($inner != NULL && $inner != ""){
            $sql.= $inner;
        }
        
        if($where != null && $where != "") {
            $sql.= " where ". $where;
        }
        $s = $db->prepare($sql);

        foreach($param as $p) {
            if(isset($p['type']))
                $s->bindValue($p['key'], $p['value'], $p['type']);
            else
                $s->bindValue($p['key'], $p['value']);
        }

        $s->execute();
        return $s->rowCount();
    }

    public function hydrate(array $datas){
        foreach ($datas as $data => $value){
            $method = 'set_'.$data;

            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function __destruct(){

    }
    
}

