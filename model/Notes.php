<?php 

namespace Model;

//use Model;

/**
 * Class model : Theme
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente un thème de vidéo
**/
class Notes extends Model{

    private $_id;
    private $_id_video;
    private $_id_utilisateur;
    private $_note;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_id_video(){
		return $this->_id_video;
	}

	public function set_id_video($_id_video){
		$this->_id_video = $_id_video;
	}

	public function get_id_utilisateur(){
		return $this->_id_utilisateur;
	}

	public function set_id_utilisateur($_id_utilisateur){
		$this->_id_utilisateur = $_id_utilisateur;
	}

    public function get_note(){
		return $this->_note;
	}

	public function set_note($_note){
		$this->_note = $_note;
    }
    
	// Requêtes BDD
	
	/***************************************/
	public static function buildModel(array $line){
		$n = new Notes([
			"id" => $line['id'],
			"id_video" => $line['id_video'],
            "id_utilisateur" => $line['id_utilisateur'],
            "note" => $line['note']
		]);
        return $n;
	}


}