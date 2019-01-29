<?php 

namespace Model;

//use Model\Model;

/**
 * Class model : Abonnement
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente l'abonnement d'un utilisateur
**/
class Abonnement extends Model{

    private $_id;
    private $_id_type;
    private $_id_utilisateur;
    private $_date_souscription;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_id_type(){
		return $this->_id_type;
	}

	public function set_id_type($_id_type){
		$this->_id_type = $_id_type;
	}

	public function get_id_utilisateur(){
		return $this->_id_utilisateur;
	}

	public function set_id_utilisateur($_id_utilisateur){
		$this->_id_utilisateur = $_id_utilisateur;
	}

	public function get_date_souscription(){
		return $this->_date_souscription;
	}

	public function set_date_souscription($_date_souscription){
		$this->_date_souscription = $_date_souscription;
	}
	   
	// Requêtes BDD

	/***************************************/
	public static function buildModel(array $line){
		$a = new Abonnement([
			"id" => $line['id'],
			"id_type" => $line['id_type'],
			"id_utilisateur" => $line['id_utilisateur'],
			"date_souscription" => $line['date_souscription']
		]);
		return $a;
	}

}