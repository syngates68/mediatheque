<?php 

namespace Model;

use PDO;

/**
 * Class model : Carte
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente une carte bancaire 
**/
class Carte extends Model{

    private $_id;
    private $_numero_carte;
    private $_date_expiration;
    private $_cryptogramme;
    private $_id_user;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_numero_carte(){
		return $this->_numero_carte;
	}

	public function set_numero_carte($_numero_carte){
		$this->_numero_carte = $_numero_carte;
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
			['key' => ':id', 'value' => $id_user, 'type' => PDO::PARAM_INT],
        ]);
	}
	
	public function carte_create(){
		return self::_create('carte', [
			['key' => 'numero_carte', 'value' => $this->get_numero_carte(), 'type' => PDO::PARAM_STR],
			['key' => 'date_expiration', 'value' => $this->get_date_expiration(), 'type' => PDO::PARAM_STR],
			['key' => 'cryptogramme', 'value' => $this->get_cryptogramme(), 'type' => PDO::PARAM_STR],
			['key' => 'id_user', 'value' => $this->get_id_user(), 'type' => PDO::PARAM_INT]
		]);

		$this->set_id($c['id']);

        return ($c['count'] > 0) ? $this : false;
	}

	/***************************************/
	public static function buildModel(array $line){
		$c = new Carte([
            "id"      		  => $line['id'],
            "numero_carte" 	  => $line['numero_carte'],
            "date_expiration" => $line['date_expiration'],
            "cryptogramme" 	  => $line['cryptogramme'],
			"id_user" 		  => $line['id_user']
		]);
		return $c;
    }

    public static function buildInner(array $line){
		$tab = array(
			"id" 		      => $line['id'],
            "numero_carte"    => $line['numero_carte'],
            "date_expiration" => $line['date_expiration'],
            "cryptogramme" 	  => $line['cryptogramme'],
			"id_user" 		  => $line['id_user']
		);
        return $tab;
    }

}