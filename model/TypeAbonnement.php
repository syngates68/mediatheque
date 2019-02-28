<?php 

namespace Model;

use PDO;

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

	public static function getAllTypeAbonnements($id_user){

        return self::_getInner('type_abonnement t ', ' t.id, t.nom, t.description, t.prix, t.essai, COALESCE(a1.nombre, 0) as periode_essai, COALESCE(a2.nombre, 0) as nbr_achats ', 'LEFT JOIN (SELECT a.id_type, COUNT(*) as nombre FROM abonnement a WHERE a.id_type = 3 AND a.id_utilisateur = :id_utilisateur)a1 ON a1.id_type = t.id LEFT JOIN (SELECT COUNT(*) as nombre, id_type FROM abonnement GROUP BY id_type ORDER BY nombre DESC LIMIT 1)a2 ON a2.id_type = t.id ', '', '', 'ORDER BY t.id', [
			['key' => ':id_utilisateur', 'value' => $id_user, 'type' => PDO::PARAM_INT],
		]);
	}

	public static function getById($id){
		return self::_getOne('type_abonnement ', ' * ', '', 'id = :id', [
			['key' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT],
        ]);
	}
	
	/***************************************/
	public static function buildModel(array $line){
		$t = new TypeAbonnement([
			"id"          => $line['id'],
			"nom"         => $line['nom'],
			"description" => $line['description'],
			"prix"        => $line['prix'],
			"essai"       => $line['essai']
		]);
        return $t;
	}

	public static function buildInner(array $line){
		$tab = array(
			"id"            => $line['id'],
			"nom"           => $line['nom'],
			"description"   => $line['description'],
			"prix"		    => $line['prix'],
			"essai" 		=> $line['essai'],
			"periode_essai" => $line['periode_essai'],
			"nbr_achats"	=> $line['nbr_achats']
		);
		return $tab;
	}

}