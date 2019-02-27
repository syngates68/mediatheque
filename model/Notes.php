<?php 

namespace Model;

use PDO;

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

	public function note_create(){
		return self::_create('notes', [
			['key' => 'id_video', 'value' => $this->get_id_video(), 'type' => PDO::PARAM_INT],
			['key' => 'id_utilisateur', 'value' => $this->get_id_utilisateur(), 'type' => PDO::PARAM_INT],
			['key' => 'note', 'value' => $this->get_note(), 'type' => PDO::PARAM_INT]
		]);

		$this->set_id($n['id']);

        return ($n['count'] > 0) ? $this : false;
	}

	public static function getNoteByUser($id_video, $id_utilisateur){
		return self::_getOne('notes ', ' * ', '', 'id_video = :id_video AND id_utilisateur = :id_utilisateur', [
			['key' => ':id_video', 'value' => $id_video, 'type' => PDO::PARAM_INT],
			['key' => ':id_utilisateur', 'value' => $id_utilisateur, 'type' => PDO::PARAM_INT],
		]);
	}

	public static function getMoyenneByVideo($id_video){
		return self::_getInner('notes ', ' *, COUNT(*) as nbr_notes, COALESCE (AVG(note), 0) as moyenne ', '', 'id_video = :id_video', '', '', [
			['key' => ':id_video', 'value' => $id_video, 'type' => PDO::PARAM_INT],
		]);
	}

	public static function deleteNote($id_user, $id_video){
		return self::_delete('notes ', 'notes ', '', 'id_video = :id_video AND id_utilisateur = :id_user', [
			['key' => 'id_video', 'value' => $id_video, 'type' => PDO::PARAM_INT],
			['key' => 'id_user', 'value' => $id_user, 'type' => PDO::PARAM_INT]
		]);
	}
	
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

	public static function buildInner(array $line){
		$tab = array(
			"id" => $line['id'],
			"id_video" => $line['id_video'],
			"id_utilisateur" => $line['id_utilisateur'],
			"note" => $line['note'],
            "nbr_notes" => $line['nbr_notes'],
            "moyenne" => $line['moyenne']
		);
		return $tab;
	}


}