<?php

namespace Config;

use \PDO;

class Database{

    private static $db = NULL;
    private static $_db_host;
    private static $_db_name;
    private static $_db_user;
    private static $_db_pass;

    public function get_db_host(){
		return $this->_db_host;
	}

	public function set_db_host($_db_host){
		$this->_db_host = $_db_host;
	}

	public function get_db_name(){
		return $this->_db_name;
	}

	public function set_db_name($_db_name){
		$this->_db_name = $_db_name;
	}

	public function get_db_user(){
		return $this->_db_user;
	}

	public function set_db_user($_db_user){
		$this->_db_user = $_db_user;
	}

	public function get_db_pass(){
		return $this->_db_pass;
	}

	public function set_db_pass($_db_pass){
		$this->_db_pass = $_db_pass;
    }
    
    public function __construct($_db_host = 'localhost', $_db_user = 'root', $_db_pass = '', $_db_name){
        $this->_db_host = $_db_host;
        $this->_db_name = $_db_name;
        $this->_db_user = $_db_user;
        $this->_db_pass = $_db_pass;
    }
    
    static function dbConnect(){

        if ($_SERVER['SERVER_NAME'] == 'localhost'){
            self::$_db_host = 'localhost';
            self::$_db_name = 'mediatheque';
            self::$_db_user = 'root';
            self::$_db_pass = '';
        }
    
        try{
            if (is_null(self::$db)){
                return self::$db = new PDO('mysql:host='.self::$_db_host.';dbname='.self::$_db_name.';charset=utf8', ''.self::$_db_user.'', ''.self::$_db_pass.'');
            }
            return self::$db;
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }

}