<?php 

namespace Model;

//use Model;

class Commentaire extends Model{

    private $_id;
    private $_id_utilisateur;
    private $_id_video;
    private $_commentaire;
    private $_date_commentaire;

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

	public function get_commentaire(){
		return $this->_commentaire;
	}

	public function set_commentaire($_commentaire){
		$this->_commentaire = $_commentaire;
	}

	public function get_date_commentaire(){
		return $this->_date_commentaire;
	}

	public function set_date_commentaire($_date_commentaire){
		$this->_date_commentaire = $_date_commentaire;
	}
    
	// Requêtes BDD

    public static function getAllCommentaireByVideo($id_video){
        return self::_getInner('commentaire c ', ' c.id, c.id_utilisateur, c.id_video, c.commentaire, c.date_commentaire, u.pseudo as pseudo, u.pic as avatar, u.id as id_user ', ' inner join utilisateur u on c.id_utilisateur = u.id ', ' id_video = :id_video ', '', 'ORDER BY c.date_commentaire DESC', [
            'id_video' => $id_video
        ]);
	}

	public static function addComment($id_user, $id_video, $commentaire){
		return self::_create('commentaire ', ' (id_utilisateur, id_video, commentaire)', '(:id_utilisateur, :id_video, :commentaire)', [
			'id_utilisateur' => $id_user,
			'id_video' => $id_video,
			'commentaire' => $commentaire
		]);
    }
	
	/***************************************/
	public static function buildModel(array $line){
		$c = new Commentaire([
			"id" => $line['id'],
			"id_utilisateur" => $line['id_utilisateur'],
			"id_video" => $line['id_video'],
			"commentaire" => $line['commentaire'],
			"date_commentaire" => $line['date_commentaire']
		]);
		return $c;
    }
    
    public static function buildInner(array $line){
		$tab = array(
			"id" => $line['id'],
			"id_utilisateur" => $line['id_utilisateur'],
			"id_video" => $line['id_video'],
			"commentaire" => $line['commentaire'],
            "date_commentaire" => $line['date_commentaire'],
            "pseudo" => $line['pseudo'],
			"avatar" => $line['avatar'],
			"id_user" => $line['id_user']
		);
		return $tab;
	}

}