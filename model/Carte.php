<?php 

namespace Model;

//use Model\Model;

use PDO;

/**
 * Class model : Carte
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente une carte bancaire 
**/
class Carte extends Model{

    private $_id;
    private $_numero;
    private $_date_expiration;
    private $_cryptogramme;
    private $_id_user;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_numero(){
		return $this->_numero;
	}

	public function set_numero($_numero){
		$this->_numero = $_numero;
	}

	public function get_date_expiration(){
		return $this->_date_expiration;
	}

	public function set_date_expiration($_date_expiration){
		$this->_date_expiration = $_date_expiration;
	}

	public function get_cryptogramme(){
		return $this->_cryptogramme;
	}

	public function set_cryptogramme($_cryptogramme){
		$this->_cryptogramme = $_cryptogramme;
	}

	public function get_id_user(){
		return $this->_id_user;
	}

	public function set_id_user($_id_user){
		$this->_id_user = $_id_user;
    }
    
	// Requêtes BDD

    public static function getByUser($id_user){
        return self::_getInner('carte c ', '  c.id, c.numero_carte, c.date_expiration, c.cryptogramme, c.id_user ', '', 'c.id_user = :id', '', '', [
			'id' => $id_user
        ]);
    }
    
    public static function addCarte($numero, $date_expiration, $crypto, $id_user){
		return self::_create('carte ', ' (numero_carte, date_expiration, cryptogramme, id_user)', '(:numero, :date_expiration, :crypto, :id_user)', [
			'numero' => sha1(md5(sha1($numero))),
			'date_expiration' => sha1(md5(sha1($date_expiration))),
			'crypto' => sha1(md5(sha1($crypto))),
			'id_user' => $id_user
		]);
	}

	/***************************************/
	public static function buildModel(array $line){
		$c = new Carte([
            "id" => $line['id'],
            "numero" => $line['numero'],
            "date_expiration" => $line['date_expiration'],
            "cryptogramme" => $line['cryptogramme'],
			"id_user" => $line['id_user']
		]);
		return $c;
    }

    public static function buildInner(array $line){
		$tab = array(
			"id" => $line['id'],
            "numero_carte" => $line['numero_carte'],
            "date_expiration" => $line['date_expiration'],
            "cryptogramme" => $line['cryptogramme'],
			"id_user" => $line['id_user']
		);
        return $tab;
    }

}