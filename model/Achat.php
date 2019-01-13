<?php 

namespace Model;

//use Model\Model;

class Achat extends Model{

    private $_id;
    private $_id_utilisateur;
    private $_id_video;
    private $_date_achat;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_id_utilisateur(){
		return $this->_id_utilisateur;
	}

	public function set_id_utilisateur($_id_utilisateur){
		$this->_id_utilisateur = $_id_utilisateur;
	}

	public function get_id_video(){
		return $this->_id_video;
	}

	public function set_id_video($_id_video){
		$this->_id_video = $_id_video;
	}

	public function get_date_achat(){
		return $this->_date_achat;
	}

	public function set_date_achat($_date_achat){
		$this->_date_achat = $_date_achat;
	}
	   
	// Requêtes BDD

    public static function getAllByUser($id_user){
        return self::_getInner('achat a', ' a.id, a.id_utilisateur, a.id_video, a.date_achat, v.titre, v.miniature, v.prix ', ' left join video v on a.id_video = v.id ', 'a.id_utilisateur = :id', '', ' ORDER BY a.date_achat DESC', [
            'id' => $id_user 
        ]);
	}

	public static function getByVideo($id_video, $id_user){
        return self::_getAll('achat a', ' a.id, a.id_utilisateur, a.id_video, a.date_achat ', 'a.id_video = '.$id_video.' AND a.id_utilisateur = '.$id_user, '', '');
	}

	/***************************************/
	public static function buildModel(array $line){
		$a = new Achat([
			"id" => $line['id'],
			"id_utilisateur" => $line['id_utilisateur'],
			"id_video" => $line['id_video'],
			"date_achat" => $line['date_achat']
		]);
		return $a;
    }
    
    public static function buildInner(array $line){
		$tab = array(
			"id" => $line['id'],
			"id_utilisateur" => $line['id_utilisateur'],
			"id_video" => $line['id_video'],
			"date_achat" => $line['date_achat'],
            "titre" => $line['titre'],
            "miniature" => $line['miniature'],
			"prix" => $line['prix']
		);
		return $tab;
	}

}