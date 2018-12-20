<?php 

namespace Model;

//use Model;

class Theme extends Model{

    private $_id;
    private $_nom;
    private $_couleur;

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

	public function get_couleur(){
		return $this->_couleur;
	}

	public function set_couleur($_couleur){
		$this->_couleur = $_couleur;
	}

	// Requêtes BDD
	
	public function __construct(array $datas){
		self::_create($datas);
	}
    
    static function getAllThemes(){

        return self::_getAll('theme', ' id, nom, couleur ', '', '', '');

    }

}