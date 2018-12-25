<?php 

namespace Model;

//use Model;

class Utilisateur extends Model{

    private $_id;
    private $_nom;
    private $_prenom;
    private $_pseudo;
    private $_date_creation;
	private $_mail;
    private $_pass;
    
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

	public function get_prenom(){
		return $this->_prenom;
	}

	public function set_prenom($_prenom){
		$this->_prenom = $_prenom;
	}

	public function get_pseudo(){
		return $this->_pseudo;
	}

	public function set_pseudo($_pseudo){
		$this->_pseudo = $_pseudo;
	}

	public function get_date_creation(){
		return $this->_date_creation;
	}

	public function set_date_creation($_date_creation){
		$this->_date_creation = $_date_creation;
	}

	public function get_mail(){
		return $this->_mail;
	}

	public function set_mail($_mail){
		$this->_mail = $_mail;
	}

	public function get_pass(){
		return $this->_pass;
	}

	public function set_pass($_pass){
		$this->_pass = $_pass;
	}

    // Requêtes BDD
    
    public static function getUser($mail, $pass){
        return self::_getOne('utilisateur u ', ' * ', '', 'u.mail = :mail AND u.pass = :pass', [
			'mail' => $mail,
			'pass' => $pass
		]);
	}

	public static function getUserById($id){
		return self::_getOne('utilisateur u', ' u.nom, u.prenom, u.pseudo, u.date_creation, u.mail, u.pass ', '', 'id = :id', [
            'id' => $id
        ]);
	}
	
	/***************************************/
	public static function buildModel(array $line){
		$u = new Utilisateur([
			"id" => $line['id'],
			"nom" => $line['nom'],
			"prenom" => $line['prenom'],
			"pseudo" => $line['pseudo'],
			"date_creation" => $line['date_creation'],
			"mail" => $line['mail'],
			"pass" => $line['pass']
		]);
		return $u;
	}

}