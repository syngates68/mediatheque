<?php 

namespace Model;

//use Model\Model;

class TypeAbonnement extends Model{

    private $_id;
    private $_nom;
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

	public function get_essai(){
		return $this->_essai;
	}

	public function set_essai($_essai){
		$this->_essai = $_essai;
	}
  
	// Requêtes BDD

	public static function getAllTypeAbonnements(){

        return self::_getAll('type_abonnement', ' id, nom, essai ', '', '', '');
	}
	
	/***************************************/
	public static function buildModel(array $line){
		$t = new TypeAbonnement([
			"id" => $line['id'],
			"nom" => $line['nom'],
			"essai" => $line['essai']
		]);
        return $t;
	}

}