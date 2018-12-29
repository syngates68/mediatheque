<?php

namespace Model;

use App\Database;
use App\Factory;
use \PDO;

abstract class Model{

    protected $table;

    public function __construct(array $datas){
        $explode = explode('\\', get_class($this));
        $class_name = lcfirst(end($explode));
        $this->table = $class_name;
        $this->hydrate($datas);
    }
    
    static function _getAll($table, $select, $where, $limit, $order){
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
            //var_dump($res);
        }

        return $res;
    }

    static function _getInner($table, $select, $inner, $where, $limit, $order, $param = []){
        $db = Database::dbConnect();
        $sql = 'SELECT'.$select.'FROM '.$table.$inner;
        if ($where != ''){
            $sql .= ' WHERE '.$where.$limit;
        }
        $sql .= $order;

        //print_r($sql);
        
        if (!empty($param)){
            $req = $db->prepare($sql);
            $req->execute($param);
        }
        else{
            $req = $db->query($sql);
        }
    
        $res = [];

        while ($line = $req->fetch()){
            array_push($res, static::buildInner($line));
            //var_dump($res);
        }

        return $res;
    }

    static function _getOne($table, $select, $inner, $where, $param = []){
        $db = Database::dbConnect();
        $sql = 'SELECT'.$select.'FROM '.$table.$inner.'WHERE '.$where;
        //echo $sql;
        $req = $db->prepare($sql);
        $req->execute($param);

        $res = [];

        while ($line = $req->fetch()){
            array_push($res, static::buildModel($line));
            //var_dump($res);
        }

        return $res;
    }

    public function hydrate(array $datas){
        foreach ($datas as $data => $value){
            $method = 'set_'.$data;

            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
        
    /*public function formatDate($date){
        setlocale(LC_TIME, 'fra', 'fr_FR');
        $date = strtotime($date);
        $date = strftime("%d/%m/%y", $date);
    
        return $date;
    }*/

    public function __destruct(){

    }
    
    /*public function getTime($date){
        setlocale(LC_TIME, 'fra', 'fr_FR');
        $date = strtotime($date)-7200;
        $now = time();
        $diff = $now-$date;
    
        $m = ($diff)/(60);
        $h = ($diff)/(60*60);
        $d = ($diff)/(60*60*24);
        $s = ($diff)/(60*60*24*7);
        $mth = ($diff)/(60*60*24*7*4);
        $y = ($diff)/(60*60*24*7*4*12);
    
        if ($diff < 60){
            return 'Il y a quelques secondes';
        }
    
        elseif ($diff >= 60 && $diff <= 3600){
            $minute = (floor($m) == 1) ? ' minute' : ' minutes';
            return 'Il y a ' . floor($m) . ' minutes';
        }
    
        elseif ($m >= 60 && $h < 24){
            $hour = (floor($h) == 1) ? ' heure' : ' heures';
            return 'Il y a ' . floor($h) . $hour;
        }
    
        elseif ($d >= 1 && $d < 7){
            $day = (floor($d) == 1) ? ' jour' : ' jours';
            return 'Il y a ' . floor($d) . $day;
        }
    
        elseif ($s >= 1 && $s < 4){
            $week = (floor($s) == 1) ? ' semaine' : ' semaines';
            return 'Il y a ' . floor($s) . $week;
        }
    
        elseif ($mth >= 1 && $mth < 12){
            return 'Il y a ' . floor($mth) . ' mois';
        }
    
        else{
            $year = (floor($y) == 1) ? ' an' : ' ans';
            return 'Il y a ' . floor($y) . $year;
        } 
    }*/
}

