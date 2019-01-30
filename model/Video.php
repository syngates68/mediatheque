<?php 

namespace Model;

//use Model;
use PDO;

/**
 * Class model : Actualités
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente une vidéo présente sur la plateforme
**/
class Video extends Model{

    private $_id;
	private $_titre;
	private $_description;
    private $_id_theme;
    private $_date_ajout;
    private $_gratuit;
	private $_lien;
	private $_miniature;
    private $_prix;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_titre(){
		return $this->_titre;
	}

	public function set_titre($_titre){
		$this->_titre = $_titre;
	}

	public function get_description(){
		return $this->_description;
	}

	public function set_description($_description){
		$this->_description = $_description;
	}

	public function get_id_theme(){
		return $this->_id_theme;
	}

	public function set_id_theme($_id_theme){
		$this->_id_theme = $_id_theme;
	}

	public function get_date_ajout(){
		return $this->_date_ajout;
	}

	public function set_date_ajout($_date_ajout){
		$this->_date_ajout = $_date_ajout;
	}

	public function get_gratuit(){
		return $this->_gratuit;
	}

	public function set_gratuit($_gratuit){
		$this->_gratuit = $_gratuit;
	}

	public function get_lien(){
		return $this->_lien;
	}

	public function set_lien($_lien){
		$this->_lien = $_lien;
	}

	public function get_miniature(){
		return $this->_miniature;
	}

	public function set_miniature($_miniature){
		$this->_miniature = $_miniature;
	}

	public function get_prix(){
		return $this->_prix;
	}

	public function set_prix($_prix){
		$this->_prix = $_prix;
    }
    
	// Requêtes BDD

	//SELECT v.id, v.titre, v.id_theme, v.gratuite, v.lien, v.miniature, v.prix, v.date_ajout, t.nom as theme, t.couleur, COALESCE(a1.nombre, 0) as nbr_achats from video v left join theme t on v.id_theme = t.id left join (SELECT a.id_video as id_video , COUNT(*) as nombre FROM achat a LEFT JOIN video v ON a.id_video = v.id WHERE v.id IN (SELECT id_video FROM achat WHERE id_video = id_video AND id_utilisateur = 1) GROUP BY id_video)a1 on a1.id_video = v.id 
    public static function getAllVideos($id_user){
        return self::_getInner('video v', ' v.id, v.titre, v.description, v.id_theme, v.gratuite, v.lien, v.miniature, v.prix, v.date_ajout, t.nom as theme, t.couleur, COALESCE(a1.nombre, 0) as nbr_achats, COALESCE (AVG(n.note), 0) as moyenne, COALESCE(COUNT(n.note), 0) as nbr_notes ', ' left join theme t on v.id_theme = t.id left join (SELECT a.id_video as id_video , COUNT(*) as nombre FROM achat a LEFT JOIN video v ON a.id_video = v.id WHERE v.id IN (SELECT id_video FROM achat) AND id_utilisateur = :id GROUP BY id_video)a1 on a1.id_video = v.id left join notes n on n.id_video = v.id ', '', '', ' GROUP BY v.id ORDER BY v.gratuite DESC', [
			'id' => $id_user
		]);
	}

	public static function getLastVideo(){
		return self::_getAll('video v', ' v.id, v.titre, v.description, v.id_theme, v.gratuite, v.lien, v.miniature, v.prix, v.date_ajout ', ' v.date_ajout = (SELECT MAX(date_ajout) FROM video WHERE gratuite = 1)', '', '');
	}

	public static function getVideoById($id){
		//var_dump($id);
		return self::_getOne('video v ', '  v.id, v.titre, v.description, v.id_theme, v.gratuite, v.lien, v.miniature, v.prix, v.date_ajout ', '', 'v.id = :id', [
			['key' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT],
        ]);
	}

	public static function getVideosFiltre($type, $tri, $theme = array(), $search, $id_user){
		$order = ' GROUP BY v.id ORDER BY v.gratuite DESC';
		if ($tri != ''){
			$order = $tri;
		}
		return self::_getInner('video v', ' v.id, v.titre, v.description, v.id_theme, v.gratuite, v.lien, v.miniature, v.prix, v.date_ajout, t.nom as theme, t.couleur, COALESCE(a1.nombre, 0) as nbr_achats, COALESCE (AVG(n.note), 0) as moyenne, COALESCE(COUNT(n.note), 0) as nbr_notes ', ' left join theme t on v.id_theme = t.id left join (SELECT a.id_video as id_video , COUNT(*) as nombre FROM achat a LEFT JOIN video v ON a.id_video = v.id WHERE v.id IN (SELECT id_video FROM achat) AND id_utilisateur = :id GROUP BY id_video)a1 on a1.id_video = v.id left join notes n on n.id_video = v.id ', $type.$theme.$search, '', $order, [
			'id' => $id_user
		]);
	}
	
	/***************************************/
	public static function buildModel(array $line){
		$v = new Video([
			"id" => $line['id'],
			"titre" => $line['titre'],
			"description" => $line['description'],
			"id_theme" => $line['id_theme'],
			"date_ajout" => $line['date_ajout'],
			"gratuite" => $line['gratuite'],
			"lien" => $line['lien'],
			"miniature" => $line['miniature'],
			"prix" => $line['prix']
		]);
		return $v;
	}

	public static function buildInner(array $line){
		$tab = array(
			"id" => $line['id'],
			"titre" => $line['titre'],
			"description" => $line['description'],
			"id_theme" => $line['id_theme'],
			"date_ajout" => $line['date_ajout'],
			"gratuite" => $line['gratuite'],
			"lien" => $line['lien'],
			"miniature" => $line['miniature'],
			"prix" => $line['prix'],
			"theme" => $line['theme'],
			"couleur" => $line['couleur'],
			"nbr_achats" => $line['nbr_achats'],
			"moyenne" => $line['moyenne'],
			"nbr_notes" => $line['nbr_notes']
		);
		return $tab;
	}

}