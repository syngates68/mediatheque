<?php 

namespace Model;

//use Model\Model;

/**
 * Class model : TypeAbonnement
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente un type d'abonnement 
**/
class TypeAbonnement extends Model{

    private $_id;
	private $_nom;
	private $_description;
	private $_prix;
    private $_essai;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_nom(){
		return $this->_nom;
	}

	public function set_nom($_nom){
		$this->_nom = $_nom;
	}

	public function get_description(){
		return $this->_description;
	}

	public function set_description($_description){
		$this->_description = $_description;
	}

	public function get_prix(){
		return $this->_prix;
	}

	public function set_prix($_prix){
		$this->_prix = $_prix;
	}

	public function get_essai(){
		return $this->_essai;
	}

	public function set_essai($_essai){
		$this->_essai = $_essai;
	}
  
	// Requêtes BDD

	public static function getAllTypeAbonnements(){

        return self::_getAll('type_abonnement', ' id, nom, description, prix, essai ', '', '', '');
	}
	
	/***************************************/
	public static function buildModel(array $line){
		$t = new TypeAbonnement([
			"id" => $line['id'],
			"nom" => $line['nom'],
			"description" => $line['description'],
			"prix" => $line['prix'],
			"essai" => $line['essai']
		]);
        return $t;
	}

}