<?php 

namespace Model;

use PDO;

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
	private $_actif;

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

	public function get_actif(){
		return $this->_actif;
	}

	public function set_actif($_actif){
		$this->_actif = $_actif;
	}

	public static function getByUser($id_user){
		return self::_getInner('abonnement a ', ' a.id, a.id_type, a.id_utilisateur, a.date_souscription, a.actif, (SELECT COUNT(*) FROM abonnement WHERE id_utilisateur = :id_utilisateur AND id_type = 3) as periode_essai, (CASE WHEN id_type = 3 THEN DATE_ADD(date_souscription, INTERVAL 7 day) END) as fin_periode_essai, t.nom, t.prix, t.essai, 		
		(CASE
			WHEN a.id_type = 1 THEN DATE_ADD(a.date_souscription, INTERVAL 1 DAY)
			WHEN a.id_type = 2 THEN DATE_ADD(a.date_souscription, INTERVAL 1 WEEK)
			WHEN a.id_type = 3 THEN DATE_ADD(a.date_souscription, INTERVAL 1 MONTH)
		END) as date_end ', 'LEFT JOIN type_abonnement t ON a.id_type = t.id', 'a.id_utilisateur = :id_utilisateur AND a.actif = 1 ', '', '', [
            ['key' => ':id_utilisateur', 'value' => $id_user, 'type' => PDO::PARAM_INT],
        ]);
	}


	public function abonnement_create(){
		return self::_create('abonnement', [
			['key' => 'id_type', 'value' => $this->get_id_type(), 'type' => PDO::PARAM_INT],
			['key' => 'id_utilisateur', 'value' => $this->get_id_utilisateur(), 'type' => PDO::PARAM_INT]
		]);

		$this->set_id($a['id']);

        return ($a['count'] > 0) ? $this : false;
	}

	public static function stopAbo($id_user, $id){
		return self::_update('abonnement', 'actif = 0', 'id = :id AND id_utilisateur = :id_user', [
			'id' => $id,
			'id_user' => $id_user
		]);
	}
	   
	// Requêtes BDD

	/***************************************/
	public static function buildModel(array $line){
		$a = new Abonnement([
			"id"                => $line['id'],
			"id_type"           => $line['id_type'],
			"id_utilisateur"    => $line['id_utilisateur'],
			"date_souscription" => $line['date_souscription'],
			"actif"             => $line['actif']
		]);
		return $a;
	}

	public static function buildInner(array $line){
		$tab = array(
			"id"                => $line['id'],
			"id_type"           => $line['id_type'],
			"id_utilisateur"    => $line['id_utilisateur'],
			"date_souscription" => $line['date_souscription'],
			"actif"             => $line['actif'],
			"periode_essai"     => $line['periode_essai'],
			"fin_periode_essai" => $line['fin_periode_essai'],
			"nom" 				=> $line['nom'],
			"prix"			    => $line['prix'],
			"essai" 			=> $line['essai'],
			"date_end" 			=> $line['date_end']
		);
		return $tab;
	}

}