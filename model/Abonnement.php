<?php 

namespace Model;

use Model;

require_once('Model.php');

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
	
	public function __construct(array $datas){
		self::_create($datas);
	}

	static function getAllAbonnements(){

        return self::_getAll('type_abonnement', ' id, nom, essai ', '', '', '', '');

    }

}