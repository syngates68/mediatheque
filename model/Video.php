<?php 

namespace Model;

use Model;

require_once('Model.php');

class Video extends Model{

    private $_id;
    private $_titre;
    private $_id_theme;
    private $_date_ajout;
    private $_gratuit;
    private $_lien;
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

	public function get_prix(){
		return $this->_prix;
	}

	public function set_prix($_prix){
		$this->_prix = $_prix;
    }
    
	// Requêtes BDD
	
	public function __construct(array $datas){
		self::_create($datas);
	}

    static function getAllVideos(){

        return self::_getAll('video v', ' v.titre, v.id_theme, v.gratuite, v.lien, v.prix, v.date_ajout, t.nom as theme, t.couleur ', ' left join theme t on v.id_theme = t.id ', '', '', ' ORDER BY v.gratuite DESC');
		
    }

}